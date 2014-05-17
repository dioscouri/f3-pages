<?php
namespace Pages\Admin;

class Listener extends \Prefab
{

    public function onSystemRebuildMenu($event)
    {
        if ($model = $event->getArgument('model'))
        {
            $root = $event->getArgument('root');
            $pages = clone $model;
            
            $pages->insert(array(
                'type' => 'admin.nav',
                'priority' => 40,
                'title' => 'Pages',
                'icon' => 'fa fa-file-text',
                'is_root' => false,
                'tree' => $root,
                'base' => '/admin/pages'
            ));
            
            $children = array(
                array(
                    'title' => 'Pages',
                    'route' => '/admin/pages/pages',
                    'icon' => 'fa fa-list'
                ),
                array(
                    'title' => 'Categories',
                    'route' => '/admin/pages/categories',
                    'icon' => 'fa fa-folder'
                )
            );
            
            $pages->addChildren($children, $root);
            
            \Dsc\System::instance()->addMessage('Pages added its admin menu items.');
        }
    }

    public function onAdminNavigationGetQuickAddItems($event)
    {
        $items = $event->getArgument('items');
        $tree = $event->getArgument('tree');
        
        $item = new \stdClass();
        $item->title = 'Pages';
        $item->form = \Pages\Admin\Controllers\MenuItemQuickAdd::instance()->page($event);
        $items[] = $item;
        
        $item = new \stdClass();
        $item->title = 'Pages Category';
        $item->form = \Pages\Admin\Controllers\MenuItemQuickAdd::instance()->category($event);
        $items[] = $item;
        
        $event->setArgument('items', $items);
    }
}