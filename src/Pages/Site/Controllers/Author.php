<?php 
namespace Pages\Site\Controllers;

class Author extends \Dsc\Controller 
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
    	$id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
    	$model = $this->getModel()->populateState()
            ->setState('filter.creator.id', $id);
    	
    	try {
    	    $author = (new \Users\Models\Users)->setState('filter.id', $id)->getItem();
    	    if (empty($author->id)) {
    	    	throw new \Exception;
    	    }
    	    
    		$paginated = $model->paginate();
    	} catch ( \Exception $e ) {
    		\Dsc\System::instance()->addMessage( "Invalid Items", 'error');
    		$f3->reroute( '/' );
    		return;
    	}
    	
    	$state = $model->getState();
    	\Base::instance()->set('state', $state );    	
    	\Base::instance()->set('paginated', $paginated );
    	
    	$this->app->set('meta.title', 'Pages by ' . $author->fullName() );
    	
    	$view = \Dsc\System::instance()->get('theme');
    	echo $view->render('Pages/Site/Views::pages/category.php');
    	 
    }
}