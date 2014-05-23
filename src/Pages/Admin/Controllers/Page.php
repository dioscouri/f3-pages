<?php 
namespace Pages\Admin\Controllers;

class Page extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItemCollection;

    protected $list_route = '/admin/pages/pages';
    protected $create_item_route = '/admin/pages/page/create';
    protected $get_item_route = '/admin/pages/page/read/{id}';    
    protected $edit_item_route = '/admin/pages/page/edit/{id}';
    
    protected function getModel() 
    {
        $model = new \Pages\Models\Pages;
        return $model; 
    }
    
    protected function getItem() 
    {
        $f3 = \Base::instance();
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
        $model = $this->getModel()
            ->setState('filter.id', $id);

        try {
            $item = $model->getItem();
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
            $f3->reroute( $this->list_route );
            return;
        }

        return $item;
    }
    
    protected function displayCreate() 
    {
        $f3 = \Base::instance();
        
        $item = $this->getItem();
        
        $model = new \Pages\Models\Categories;
        $categories = $model->getList();
        \Base::instance()->set('categories', $categories );
        \Base::instance()->set('selected', 'null' );

        $selected = array();
        $flash = \Dsc\Flash::instance();
        $input = $flash->old('category_ids');

        if (!empty($input)) 
        {
            foreach ($input as $id)
            {
                $id = $this->inputfilter->clean( $id, 'alnum' );
                $selected[] = array('id' => $id);
            }
        }
        
        $flash->store( (array) $flash->get('old') + array('categories'=>$selected));        

        $all_tags = $this->getModel()->getTags();
        \Base::instance()->set('all_tags', $all_tags );
        
        $this->app->set('meta.title', 'Create Page');
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayPagesEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        
        echo $view->render('Pages/Admin/Views::pages/create.php');
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();

        $item = $this->getItem();
        
        $model = new \Pages\Models\Categories;
        $categories = $model->getList();
        \Base::instance()->set('categories', $categories );
        \Base::instance()->set('selected', 'null' );
        
        $all_tags = $this->getModel()->getTags();
        \Base::instance()->set('all_tags', $all_tags );
        
        $this->app->set('meta.title', 'Edit Page');
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayPagesEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        
        echo $view->render('Pages/Admin/Views::pages/edit.php');
    }
    
    /**
     * This controller doesn't allow reading, only editing, so redirect to the edit method
     */
    protected function doRead(array $data, $key=null) 
    {
        $f3 = \Base::instance();
        $id = $this->getItem()->get( $this->getItemKey() );
        $route = str_replace('{id}', $id, $this->edit_item_route );
        $f3->reroute( $route );
    }
    
    protected function displayRead() {}
}