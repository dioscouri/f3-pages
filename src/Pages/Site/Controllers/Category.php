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
        
        $path = $this->inputfilter->clean($f3->get('PARAMS.1'), 'string');
        $model = $this->getModel();
        
        try
        {
            $category = (new \Pages\Models\Categories)->setState('filter.path', $path)->getItem();
            if (empty($category->id))
            {
                throw new \Exception();
            }
            $paginated = $model->populateState()
                ->setState('filter.category.id', (string) $category->id)
                ->setState('filter.publication_status', 'published')
                ->setState('filter.published_today', true)
                ->paginate();
        }
        catch (\Exception $e)
        {
            \Dsc\System::instance()->addMessage("Invalid Items", 'error');
            $f3->reroute('/blog');
            return;
        }
        
        $state = $model->getState();
        \Base::instance()->set('state', $state);
        \Base::instance()->set('paginated', $paginated);
        \Base::instance()->set('category', $category);
        
        $this->app->set('meta.title', $category->seoTitle() . ' | Pages');
        $this->app->set('meta.description', $category->seoDescription() );        
        
        $view = \Dsc\System::instance()->get('theme');
        $view_file = 'index.php';
        if ($category->{'display.view'} && $view->findViewFile( 'Pages/Site/Views::categories/index/' . $category->{'display.view'} )) {
            $view_file = 'index/' . $category->{'display.view'};
        }
        echo $view->render('Pages/Site/Views::categories/' . $view_file);
    }
}