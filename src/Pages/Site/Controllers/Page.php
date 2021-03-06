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
    	$slug = $this->inputfilter->clean( $this->app->get('PARAMS.slug'), 'cmd' );
    	$model = $this->getModel()->populateState()->setState('filter.type', true)
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
    		$this->app->error( '404' );
    		return;
    	}
    	
    	$this->app->set('item', $item );
    	
    	$this->app->set('meta.title', $item->seoTitle());
    	$this->app->set('meta.description', $item->seoDescription() );
    	
    	\Pages\Models\Activities::track('Viewed Page', array(
    	    'Page Title' => $item->seoTitle(),
    	    'page_id' => (string) $item->id
    	));    	
    	    	
    	$view = \Dsc\System::instance()->get('theme');
    	
    	$view_file = 'view.php';
    	if ($item->{'display.view'} && $view->findViewFile( 'Pages/Site/Views::pages/view/' . $item->{'display.view'} )) {
    		$view_file = 'view/' . $item->{'display.view'};
    	} 
    	
    	echo $view->renderTheme('Pages/Site/Views::pages/' . $view_file);
    }
}