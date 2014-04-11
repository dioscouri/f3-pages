<?php 
namespace Pages\Admin;

class Listener extends \Prefab 
{
    public function onSystemRebuildMenu( $event )
    {
        if ($mapper = $event->getArgument('mapper')) 
        {
            $mapper->reset();
            $mapper->priority = 30;
            $mapper->id = 'f3-pages';
            $mapper->title = 'Pages';
            $mapper->route = '';
            $mapper->icon = 'fa fa-file-text';
            $mapper->children = array(
                    json_decode(json_encode(array( 'title'=>'Pages', 'route'=>'/admin/pages/pages', 'icon'=>'fa fa-list' )))
                    ,json_decode(json_encode(array( 'title'=>'Categories', 'route'=>'/admin/pages/categories', 'icon'=>'fa fa-folder' )))
                    //,json_decode(json_encode(array( 'title'=>'Settings', 'route'=>'/admin/pages/settings', 'icon'=>'fa fa-cogs' )))
            );
            $mapper->save();
            
            \Dsc\System::instance()->addMessage('Pages added its admin menu items.');
        }
    }
    
    public function onAdminNavigationGetQuickAddItems( $event )
    {
        $items = $event->getArgument('items');
        $tree = $event->getArgument('tree');
        
        /*
        $item = new \stdClass;
        $item->title = 'Pages Category';
        $item->form = \Pages\Admin\Controllers\MenuItemQuickAdd::instance()->category($event);
        $items[] = $item;
        
        $item = new \stdClass;
        $item->title = 'Pages Tag';
        $item->form = \Pages\Admin\Controllers\MenuItemQuickAdd::instance()->tag($event);

        */
                
        
        $items[] = $item;
        
        $event->setArgument('items', $items);
    }
}