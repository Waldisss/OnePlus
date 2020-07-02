<?php

class View
{
    private $viewsPath;

    public function __construct($viewsPath = null)
    {
        $config_param = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/conf/conf.ini');
        $defaultViewsPath = $config_param['default_views_path'];

        $this->viewsPath = $_SERVER['DOCUMENT_ROOT'];
        $this->viewsPath .= is_null($viewsPath) ? $defaultViewsPath : $viewsPath;
    }

    public function render($view, $vars = array()) {
        if (!is_file($this->viewsPath.$view.'.php')){
            echo 'View "'.$view.'" not exists';
        }

        extract($vars);
        ob_start();
        include($this->viewsPath.$view.'.php');
        return ob_get_clean();
    }
}