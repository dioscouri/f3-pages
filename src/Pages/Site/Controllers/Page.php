<?php 
namespace Pages\Site\Controllers;

class Page extends \Dsc\Controller 
{    
	use \Dsc\Traits\Controllers\SupportPreview;
	
	protected function getModel() 
    {
        $model = new \Pages\Models\Pages;
        return $model; 
    }
    
    public function read()
    {
    	// TODO Check ACL against page.
    	
    	$f3 = \Base::instance();
    	$slug = $this->inputfilter->clean( $f3->get('PARAMS.slug'), 'cmd' );
    	$model = $this->getModel()->populateState()
            ->setState('filter.slug', $slug);
    	
    	$preview = $this->input->get( "preview", 0, 'int' );
    	if( $preview ){
    		$this->canPreview();
    	} else {
    		$model->setState('filter.published_today', true)
    		->setState('filter.publication_status', 'published');
    	}
    	    	
    	try {
    		$item = $model->getItem();
    		
    		if (empty($item->id))
    		{
    		    throw new \Exception;
    		}
    		
    	} catch ( \Exception $e ) {
    		\Dsc\System::instance()->addMessage( "Invalid Item", 'error');
    		$f3->reroute( '/' );
    		return;
    	}
    	
    	\Base::instance()->set('item', $item );
    	
    	$this->app->set('meta.title', $item->title);
    	
    	$view = \Dsc\System::instance()->get('theme');
    	
    	$view_file = 'view.php';
    	if ($item->{'display.view'} && $view->findViewFile( 'Pages/Site/Views::pages/view/' . $item->{'display.view'} )) {
    		$view_file = 'view/' . $item->{'display.view'};
    	} 
    	
    	echo $view->renderTheme('Pages/Site/Views::pages/' . $view_file);
    }
}