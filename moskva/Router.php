<?php
class Router{
    private $config;
    public function __construct($dir){
        $this -> config = include "{$dir}/config/router.config.php";
    }

    public function resolveUrl($url){
        $defaultRoute = '/\/(?P<controller>[0-9A-Za-z]+)(\/(?P<action>[0-9A-Za-z]+))?/';

        preg_match($defaultRoute, $url, $matches);
        $controller = $matches['controller'];
        $action = $matches['action'];

        if(empty($controller)){
            $controller = $this -> config['default_controller'];
        }
        if(empty($action)){
            $action = $this -> config['default_action'];
        }

        return array(
            'controller' => $controller,
            'action' => $action
        );
    }
}
