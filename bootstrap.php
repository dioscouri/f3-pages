<?php
class PagesBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;

    protected $namespace = 'Pages';

    protected function preSite()
    {
        if (class_exists('\Search\Factory'))
        {
            \Search\Factory::registerSource(new \Search\Models\Source(array(
                'id' => 'pages',
                'title' => 'Pages',
                'class' => '\Pages\Models\Pages'
            )));
        }
    }

    protected function preAdmin()
    {
        if (class_exists('\Search\Factory'))
        {
            \Search\Factory::registerSource(new \Search\Models\Source(array(
                'id' => 'pages',
                'title' => 'Pages',
                'class' => '\Pages\Models\Pages',
            )));
        }
    }
}
$app = new PagesBootstrap();