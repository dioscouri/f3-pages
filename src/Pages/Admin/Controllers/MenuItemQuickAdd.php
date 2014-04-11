<?php 
namespace Pages\Admin\Controllers;

class MenuItemQuickAdd extends \Admin\Controllers\BaseAuth 
{
	public function category($event)
	{
		$model = \Pages\Models\Categories::instance();
		$categories = $model->getList();
		\Base::instance()->set('categories', $categories );
		
		$view = \Dsc\System::instance()->get('theme');
		return $view->renderLayout('Pages/Admin/Views::quickadd/category.php');
	}
	
	public function tag($event)
	{
	    $model = new \Pages\Models\Pages;
	    $tags = $model->getTags();
	    \Base::instance()->set('tags', $tags );
	
	    $view = \Dsc\System::instance()->get('theme');
	    return $view->renderLayout('Pages/Admin/Views::quickadd/tag.php');
	}
}