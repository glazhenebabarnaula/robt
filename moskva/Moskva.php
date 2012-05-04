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
        Moskva::$_instance -> rootDir = $dir;
	}

	/**
	 * @static
	 * return Moskva
	 */
	public static function getInstance() {
		return self::$_instance;
	}

	public function handleHttpRequest() {
		$requestedUri = $_SERVER['REQUEST_URI'];
        $router = new Router($this -> rootDir);
        $routeArray = $router -> resolveUrl($requestedUri);
        $controller = $routeArray['controller'];
        $action = $routeArray['action'];

        Autoloader::loadControllers("{$this->rootDir}/controllers");

        if(class_exists($controller)){
            $instance = new $controller();
            $instance -> $action();
        }
        else{
            echo 404;
        }
    }

}