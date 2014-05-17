<?php 
namespace Pages\Site\Controllers;

class Tag extends \Dsc\Controller 
{    
    protected function getModel() 
    {
        $model = new \Pages\Models\Pages;
        return $model; 
    }
    
    public function index()
    {
    	$f3 = \Base::instance();
    	
    	$tag = $this->inputfilter->clean( $f3->get('PARAMS.tag') );
    	$model = $this->getModel()->populateState()
            ->setState('filter.tag', $tag);
    	
    	try {
    		$paginated = $model->paginate();
    	} catch ( \Exception $e ) {
    		\Dsc\System::instance()->addMessage( "Invalid Items", 'error');
    		$f3->reroute( '/' );
    		return;
    	}
    	
    	$state = $model->getState();
    	\Base::instance()->set('state', $state );
    	\Base::instance()->set('paginated', $paginated );
    	
    	$this->app->set('meta.title', 'Tag: ' . $tag . ' | Pages');
    	
    	$view = \Dsc\System::instance()->get('theme');
    	echo $view->render('Pages/Site/Views::pages/category.php');
    	 
    }
}