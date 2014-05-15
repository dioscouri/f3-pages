<?php 
namespace Pages\Admin\Controllers;

class Pages extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\AdminList;
		
    protected $list_route = '/admin/pages/pages';

    protected function getModel($name = 'pages')
    {
        $model = null;
        switch( $name ) {
        	case 'pages' :
		        $model = new \Pages\Models\Pages;
        		break;
       		case 'categories' :
       			$model = new \Pages\Models\Categories;
       			break;
        }
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
        
        $categories_db = (array) $this->getModel( "categories" )->getItems();
        $categories = array(
        	array( 'text' => 'All Categories', 'value' => ' ' ),
       		array( 'text' => '- Uncategorized -', 'value' => '--' ),
        );
        array_walk( $categories_db, function($cat) use(&$categories) {
        	$categories []= array(
        			'text' => $cat->title,
        			'value' => (string)$cat->slug,
        	);
        } );
        
        \Base::instance()->set('categories', $categories );
        
        $all_tags = array(
       		array( 'text' => 'All Tags', 'value' => ' ' ),
       		array( 'text' => '- Untagged -', 'value' => '--' ),
        );
        $tags = (array) $this->getModel()->getTags();
        array_walk( $tags, function($tag) use(&$all_tags) {
        	$all_tags []= array(
        			'text' => $tag,
        			'value' => $tag
        	);
        } );

        \Base::instance()->set('all_tags', $all_tags );
        
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Pages/Admin/Views::pages/list.php');
    }
}