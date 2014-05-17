<?php
namespace Pages\Site;

class Routes extends \Dsc\Routes\Group
{
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Pages\Site\Controllers',
            'url_prefix' => '/pages' 
        ) );
        
        $this->add( '/@slug', 'GET', array(
            'controller' => 'Page',
            'action' => 'read' 
        ) );
        
        $this->add( '/category/*', 'GET', array(
            'controller' => 'Category',
            'action' => 'index' 
        ) );
        
        $this->add( '/category/*/page/@page', 'GET', array(
            'controller' => 'Category',
            'action' => 'index' 
        ) );
        
        $this->add( '/tag/@tag', 'GET', array(
            'controller' => 'Tag',
            'action' => 'index' 
        ) );
        
        $this->add( '/tag/@tag/page/@page', 'GET', array(
            'controller' => 'Tag',
            'action' => 'index' 
        ) );
        
        $this->add( '/author/@id', 'GET', array(
            'controller' => 'Author',
            'action' => 'index' 
        ) );
        
        $this->add( '/author/@id/page/@page', 'GET', array(
            'controller' => 'Author',
            'action' => 'index' 
        ) );
    }
}