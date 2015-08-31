<?php 
namespace Pages;

class Listener extends \Prefab 
{
	function siteMapRegisterRoutes($event) {
		$routes = $event->getArgument('routes');
		 
		 
		$slugs = (new \Pages\Models\Pages)->collection()->distinct('slug', ['publication.status' => ['$ne' => 'unpublished']]);
		 
		//products
		$pageRoutes = array_map( function($val) { return ['loc' => '/pages/'.$val,
				'pri' => '1.0',
				'change' => 'weekly',
				'mod' => null ];
		}, $slugs);
		//
		
		$routes['pages'] = $pageRoutes;
		 
		$event->setArgument('routes', $routes);
		 
	}
}