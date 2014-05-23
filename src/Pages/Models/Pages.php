<?php
namespace Pages\Models;

class Pages extends \Dsc\Mongo\Collections\Content
{
    use\Search\Traits\SearchItem;

    public $categories = array();

    public $featured_image = array();

    protected $__config = array(
        'default_sort' => array(
            'publication.start.time' => -1
        )
    );

    protected $__type = 'pages.pages';

    protected function fetchConditions()
    {
        parent::fetchConditions();
        
        $this->setCondition('type', $this->__type);
        
        $filter_category_slug = trim($this->getState('filter.category.slug'));
        if (strlen($filter_category_slug))
        {
            if ($filter_category_slug == '--')
            {
                $this->setCondition('categories', array(
                    '$size' => 0
                ));
            }
            else
            {
                $this->setCondition('categories.slug', $filter_category_slug);
            }
        }
        
        $filter_category_id = $this->getState('filter.category.id');
        if (strlen($filter_category_id))
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
            'summary' => substr($this->copy, 0, 250),
            'datetime' => $this->{'publication.start.local'}
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