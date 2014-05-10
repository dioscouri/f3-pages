<?php 
namespace Pages\Admin\Controllers;

class Pages extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\AdminList;
		
    protected $list_route = '/admin/pages/pages';

    protected function getModel()
    {
        $model = new \Pages\Models\Pages;
        return $model;
    }
	
	public function index()
    {
        // when ACL is ready
        //$this->checkAccess( __CLASS__, __FUNCTION__ );
        
        \Base::instance()->set('pagetitle', 'Pages');
        \Base::instance()->set('subtitle', '');
        
        $model = $this->getModel();
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated );
        
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Pages/Admin/Views::pages/list.php');
    }
}