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
    	// TODO get the slug param.  lookup the category.  Check ACL against both category.
    	// get paginated list of pages pages associated with this category
    	// only pages that are published as of now
    	
    	$f3 = \Base::instance();
    	$slug = $this->inputfilter->clean( $f3->get('PARAMS.slug'), 'cmd' );
    	$model = $this->getModel()->populateState()
            ->setState('filter.category.slug', $slug);
    	
    	try {
    		$paginated = $model->paginate();
    	} catch ( \Exception $e ) {
    	    // TODO Change to a normal 404 error
    		\Dsc\System::instance()->addMessage( "Invalid Items: " . $e->getMessage(), 'error');
    		$f3->reroute( '/' );
    		return;
    	}
    	
    	\Base::instance()->set('pagetitle', 'Pages');
    	\Base::instance()->set('subtitle', '');
    	
    	$state = $model->getState();
    	\Base::instance()->set('state', $state );
    	
        \Base::instance()->set('paginated', $paginated );
    	
    	$view = \Dsc\System::instance()->get('theme');
    	echo $view->render('Pages/Site/Views::pages/category.php');
    	 
    }
}