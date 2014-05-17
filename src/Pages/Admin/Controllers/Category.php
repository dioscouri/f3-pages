<?php 
namespace Pages\Admin\Controllers;

class Category extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItem;

    protected $list_route = '/admin/pages/categories';
    protected $create_item_route = '/admin/pages/category/create';
    protected $get_item_route = '/admin/pages/category/read/{id}';    
    protected $edit_item_route = '/admin/pages/category/edit/{id}';
    
    protected function getModel() 
    {
        $model = new \Pages\Models\Categories;
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

        $model = new \Pages\Models\Categories;
        $all = $model->emptyState()->getList();
        \Base::instance()->set('all', $all );
        \Base::instance()->set('selected', null );
        
        $this->app->set('meta.title', 'Create Category | Pages');
        
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Pages/Admin/Views::categories/create.php');        
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();

        $model = new \Pages\Models\Categories;
        $categories = $model->emptyState()->getList();
        \Base::instance()->set('categories', $categories );
        
        $flash = \Dsc\Flash::instance();
        $selected = $flash->old('parent');
        \Base::instance()->set('selected', $selected );

        $this->app->set('meta.title', 'Edit Category | Pages');
        
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Pages/Admin/Views::categories/edit.php');
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
    
    public function quickadd() 
    {
    	$model = $this->getModel();
    	$categories = $model->getList();
    	\Base::instance()->set('categories', $categories );
    	
    	$view = \Dsc\System::instance()->get('theme');
    	echo $view->renderLayout('Pages/Admin/Views::categories/quickadd.php');
    }
}