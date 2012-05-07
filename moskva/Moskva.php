<?php

require_once 'Router.php';
require_once 'autoload/Autoloader.php';

class Moskva {

	/**
	 * @var $_instance Moskva
	 */
	private static $_instance = null;
    private $rootDir;
	public static function createInstance($dir) {
		Moskva::$_instance = new Moskva();
        Moskva::$_instance->rootDir = $dir;
	}

	/**
	 * @static
	 * return Moskva
	 */
	public static function getInstance() {
		return self::$_instance;
	}

    private function getArgumentsOfAction($controllerName, $actionName){
        $r = new ReflectionMethod($controllerName, $actionName);
        $args = $r->getParameters();
        $argsInRequest = array();
        foreach ($args as $arg) {
            $argName = $arg->getName();
            if(isset($_GET[$argName]) && !empty($_GET[$argName])){
                $argsInRequest[$argName] = $_GET[$argName];
            }
            else{
                if(!$arg->isOptional()){
                    echo "400, not enough parameters in url";
                    exit();
                }
            }
        }
        return $argsInRequest;
    }

	public function handleHttpRequest() {
		$requestedUri = $_SERVER['REQUEST_URI'];
        $router = new Router($this->rootDir);
        $routeArray = $router->resolveUrl($requestedUri);
        $controller = $routeArray['controller'];
        $action = $routeArray['action'];

        Autoloader::loadControllers("{$this->rootDir}/controllers");

        if(class_exists($controller)){
            $instance = new $controller();
            if(method_exists($instance, $action)){
                $args = $this->getArgumentsOfAction($controller,$action);
                $instance->$action($args);
                exit();
            }
        }
        echo "404, controller or action not found";
    }
}