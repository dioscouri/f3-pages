<?php

namespace Pages\Site;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Routes extends \Dsc\Routes\Group{
	
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){
		$this->setDefaults(
				array(
					'namespace' => '\Pages\Site\Controllers',
					'url_prefix' => '/pages'
				)
		);
		
		$this->add( '', 'GET', array(
							'controller' => 'Home',
							'action' => 'index'
						));

		$this->add( '/page/@page', 'GET', array(
				'controller' => 'Home',
				'action' => 'index'
		));

		$this->add( '/page/@slug', 'GET', array(
				'controller' => 'Page',
				'action' => 'read'
		));

		$this->add( '/page/@slug/@page', 'GET', array(
				'controller' => 'Page',
				'action' => 'read'
		));

		$this->add( '/category/@slug', 'GET', array(
				'controller' => 'Category',
				'action' => 'index'
		));

		$this->add( '/category/@slug/@page', 'GET', array(
				'controller' => 'Category',
				'action' => 'index'
		));

		$this->add( '/tag/@tag', 'GET', array(
				'controller' => 'Tag',
				'action' => 'index'
		));

		$this->add( '/tag/@tag/@page', 'GET', array(
				'controller' => 'Tag',
				'action' => 'index'
		));

		$this->add( '/author/@id', 'GET', array(
				'controller' => 'Author',
				'action' => 'index'
		));

		$this->add( '/author/@id/@page', 'GET', array(
				'controller' => 'Author',
				'action' => 'index'
		));
	}
}