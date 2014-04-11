<?php 
namespace Pages\Models;

class Pages extends \Dsc\Mongo\Collections\Content 
{
    public $categories = array();
    public $featured_image = array();
    
    protected $__type = 'pages.pages';
    
    protected function fetchConditions()
    {
        parent::fetchConditions();
        
        $this->setCondition('type', $this->__type );
        
        $filter_category_slug = $this->getState('filter.category.slug');
        if (strlen($filter_category_slug))
        {
            $this->setCondition('categories.slug', $filter_category_slug );
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
            if ($list = (new \Pages\Models\Categories)->setState('select.fields', array('title', 'slug'))->setState('filter.ids', $category_ids)->getList()) 
            {
                foreach ($list as $list_item) {
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
        
        unset($this->parent);
        unset($this->new_category_title);

        return parent::beforeValidate();
    }
    
    public function validate()
    {
        if (empty($this->copy)) {
            $this->setError('Body copy is required');
        }
        
        return parent::validate();
    }
}