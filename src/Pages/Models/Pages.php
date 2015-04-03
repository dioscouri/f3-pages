<?php
namespace Pages\Models;

class Pages extends \Dsc\Mongo\Collections\Content
{
    public $categories = array();

    public $featured_image = array();
    
    public $links = array();

    protected $__config = array(
        'default_sort' => array(
            'publication.start.time' => -1
        )
    );

    protected $__type = 'pages.pages';

    protected function fetchConditions()
    {
        parent::fetchConditions();
        
        $key = new \MongoRegex('/'.$this->type().'/i');
        $this->setCondition('type', $key);
        
        $filter_category_slug = $this->getState('filter.category.slug');
        if (is_array($filter_category_slug) && !empty($filter_category_slug))
        {
            $this->setCondition('categories.slug', array('$in' => array_values( array_filter( $filter_category_slug ) ) ));
        }
        elseif (is_string($filter_category_slug) && strlen($filter_category_slug))
        {
            $filter_category_slug = trim($filter_category_slug);
            
            if ($filter_category_slug == '--')
            {
                $this->setCondition('categories', array(
                    '$size' => 0
                ));
            }
            elseif(strlen($filter_category_slug))
            {
                $this->setCondition('categories.slug', $filter_category_slug);
            }
        }
        
        $filter_category_id = $this->getState('filter.category.id');
        if (is_array($filter_category_id) && !empty($filter_category_id))
        {
            $this->setCondition('categories.id', array('$in' => array_values( array_filter( $filter_category_id ) ) ));
        }        
        elseif (is_string($filter_category_id) && strlen($filter_category_id))
        {
            $this->setCondition('categories.id', new \MongoId((string) $filter_category_id));
        }
        
        return $this;
    }

    protected function beforeValidate()
    {
        if (!empty($this->category_ids))
        {
            $category_ids = $this->category_ids;
            unset($this->category_ids);
            
            $categories = array();
            if ($list = (new \Pages\Models\Categories())->setState('select.fields', array(
                'title',
                'slug'
            ))
                ->setState('filter.ids', $category_ids)
                ->getList())
            {
                foreach ($list as $list_item)
                {
                    $cat = array(
                        'id' => $list_item->id,
                        'title' => $list_item->title,
                        'slug' => $list_item->slug
                    );
                    $categories[] = $cat;
                }
            }
            $this->categories = $categories;
        }
        
        if (!empty($this->images))
        {
            $images = array();
            $current = $this->images;
            $this->images = array();
            
            foreach ($current as $image)
            {
                if (!empty($image['image']))
                {
                    $images[] = array(
                        'image' => $image['image']
                    );
                }
            }
            
            $this->images = $images;
        }
        
        unset($this->parent);
        unset($this->new_category_title);
        
        $this->links = array_values( array_filter( $this->links ) );
        
        return parent::beforeValidate();
    }

    public function validate()
    {
        if (empty($this->copy))
        {
            $this->setError('Body copy is required');
        }
        
        return parent::validate();
    }

    /**
     * Converts this to a search item, used in the search template when displaying each search result
     */
    public function toSearchItem()
    {
        $image = (!empty($this->{'featured_image.slug'})) ? './asset/thumb/' . $this->{'featured_image.slug'} : null;
        
        $item = new \Search\Models\Item(array(
            'url' => './pages/' . $this->slug,
            'title' => $this->title,
            'subtitle' => '',
            'image' => $image,
            'summary' => $this->getAbstract(array('strip_tags' => true)),
            'datetime' => $this->{'publication.start.local'}
        ));
        
        return $item;
    }
    
    /**
     * Converts this to a search item, used in the search template when displaying each search result
     */
    public function toAdminSearchItem()
    {
        $image = (!empty($this->{'featured_image.slug'})) ? './asset/thumb/' . $this->{'featured_image.slug'} : null;
        $published_status = '<span class="label ' . $this->publishableStatusLabel() . '">' . $this->{'publication.status'} . '</span>';
        
        $item = new \Search\Models\Item(array(
            'url' => './admin/pages/page/edit/' . $this->id,
            'title' => $this->title,
            'subtitle' => 'By: ' . $this->{'metadata.creator.name'},
            'image' => $image,
            'summary' => $this->getAbstract(array('strip_tags' => true)),
            'datetime' => $published_status . ' ' . date('Y-m-d', $this->{'publication.start.time'} ),
        ));
    
        return $item;
    }

    /**
     * Get all the images associated with a product
     * incl.
     * featured image, related images, etc
     *
     * @param unknown $cast            
     * @return array
     */
    public function images()
    {
        $featured_image = array();
        if (!empty($this->featured_image['slug']))
        {
            $featured_image = array(
                $this->featured_image['slug']
            );
        }
        
        $related_images = \Dsc\ArrayHelper::where($this->images, function ($key, $ri)
        {
            if (!empty($ri['image']))
            {
                return $ri['image'];
            }
        });
        
        $images = array_unique(array_merge(array(), (array) $featured_image, (array) $related_images));
        
        return $images;
    }
}