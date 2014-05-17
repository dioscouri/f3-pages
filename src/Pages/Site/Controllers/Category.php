<?php 
namespace Pages\Site\Controllers;

class Category extends \Dsc\Controller 
{    
    protected function getModel() 
    {
        $model = new \Pages\Models\Pages;
        return $model; 
    }
    
    public function index()
    {
    	$f3 = \Base::instance();
    	
    	$param = $this->inputfilter->clean( $f3->get('PARAMS.1'), 'string' );
    	$pieces = explode('?', $param);
    	$path = $pieces[0];
    	
    	try {
    	    $category = (new \Pages\Models\Categories)->setState('filter.path', $path)->getItem();
    	    if (empty($category->id)) {
    	        throw new \Exception;
    	    }
    	        	    
    		$paginated = $products_model->populateState()
    		      ->setState('filter.category.id', $category->id)
    		      ->setState('filter.publication_status', 'published')
    		      ->setState('filter.published_today', true)
    		      ->paginate();
    		
    	} 
    	catch ( \Exception $e ) 
    	{
    		\Dsc\System::instance()->addMessage( "Invalid Items", 'error');
    		$f3->reroute( '/' );
    		return;
    	}
    	
    	$state = $model->getState();
    	\Base::instance()->set('state', $state );
        \Base::instance()->set('paginated', $paginated );
        
        $this->app->set('meta.title', $category->title . ' | Pages');
    	
    	$view = \Dsc\System::instance()->get('theme');
    	echo $view->render('Pages/Site/Views::pages/category.php');
    	 
    }
}