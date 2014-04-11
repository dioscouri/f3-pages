<?php 
namespace Pages\Site\Controllers;

class Page extends \Dsc\Controller 
{    
    protected function getModel() 
    {
        $model = new \Pages\Models\Pages;
        return $model; 
    }
    
    public function read()
    {
    	// TODO get the slug param.  lookup the pages page.  Check ACL against page.
    	
    	$f3 = \Base::instance();
    	$slug = $this->inputfilter->clean( $f3->get('PARAMS.slug'), 'cmd' );
    	$model = $this->getModel()->populateState()
            ->setState('filter.slug', $slug);
    	
    	try {
    		$item = $model->getItem();
    	} catch ( \Exception $e ) {
    	    // TODO Change to a normal 404 error
    		\Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
    		$f3->reroute( '/' );
    		return;
    	}
    	
    	\Base::instance()->set('pagetitle', $item->title);
    	\Base::instance()->set('subtitle', '');
    	
    	\Base::instance()->set('item', $item );
    	
    	$view = \Dsc\System::instance()->get('theme');
    	echo $view->renderTheme('Pages/Site/Views::pages/view.php');
    	 
    }
}