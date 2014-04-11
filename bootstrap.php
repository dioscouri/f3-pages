<?php
class PagesBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Pages';
}
$app = new PagesBootstrap();