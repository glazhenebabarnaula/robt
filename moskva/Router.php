<?php
class Router{
    private $config;
    public function __construct(){
        $this -> config = Moskva::getInstance()->loadConfig('router');
    }

    public function resolveUrl($url){
        $defaultRoute = '/\/(?P<controller>[0-9A-Za-z]+)(\/(?P<action>[0-9A-Za-z]+))?/';

        preg_match($defaultRoute, $url, $matches);

        $controller = $this->getFromConfigIfNotExists($matches,'controller','default_controller');
        $action = $this->getFromConfigIfNotExists($matches,'action','default_action');

        return array(
            'controller' => $controller . 'Controller',
            'action' => $action . 'Action'
        );
    }

    private function getFromConfigIfNotExists($arr,$key,$default)
    {
        return isset($arr[$key]) ? $arr[$key] : $this->config[$default];
    }
}
