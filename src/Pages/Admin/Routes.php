<?php
namespace Pages\Admin;

class Routes extends \Dsc\Routes\Group
{
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Pages\Admin\Controllers',
            'url_prefix' => '/admin/pages' 
        ) );
        
        $this->addSettingsRoutes();
        $this->addCrudGroup( 'Pages', 'Page' );
        $this->addCrudGroup( 'Categories', 'Category', array(
            'datatable_links' => true,
            'get_parent_link' => true 
        ) );
        $this->add( '/checkboxes', array(
            'GET',
            'POST' 
        ), array(
            'controller' => 'Categories',
            'action' => 'getCheckboxes' 
        ) );
    }
}