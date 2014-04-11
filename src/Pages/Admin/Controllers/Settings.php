<?php 
namespace Pages\Admin\Controllers;

class Settings extends \Admin\Controllers\BaseAuth 
{
	use \Dsc\Traits\Controllers\Settings;
	
	protected $layout_link = 'Pages/Admin/Views::settings/default.php';
	protected $settings_route = '/admin/pages/settings';
    
    protected function getModel()
    {
        $model = new \Pages\Models\Settings;
        return $model;
    }
}