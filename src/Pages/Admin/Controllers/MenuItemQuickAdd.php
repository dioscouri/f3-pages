<?php 
namespace Pages\Admin\Controllers;

class MenuItemQuickAdd extends \Admin\Controllers\BaseAuth 
{
	public function category($event)
	{
		$model = new \Pages\Models\Categories;
		$categories = $model->getList();
		\Base::instance()->set('categories', $categories );
		
		$view = \Dsc\System::instance()->get('theme');
		return $view->renderLayout('Pages/Admin/Views::quickadd/category.php');
	}
	
	public function page($event)
	{
	    $view = \Dsc\System::instance()->get('theme');
	    return $view->renderLayout('Pages/Admin/Views::quickadd/page.php');
	}
}