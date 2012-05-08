<?php

require_once 'Router.php';
require_once 'autoload/Autoloader.php';

class Moskva {

	/**
	 * @var $_instance Moskva
	 */
	private static $_instance = null;
	public static function createInstance($dir) {
		Moskva::$_instance = new Moskva($dir);
	}

	/**
	 * @static
	 * return Moskva
	 */
	public static function getInstance() {
		return self::$_instance;
	}


	private $rootDir;

	private $db;

	private function __construct($dir) {
		set_error_handler(array($this, 'handleError'));
		set_exception_handler(array($this, 'handleException'));
		spl_autoload_register(array($this, 'handleClassNotFound'));
		error_reporting(E_ALL);

		$this->rootDir = $dir;

		Autoloader::getInstance()->loadMoskvaParts();

		$this->db = new mDbConnection($this->loadConfig('database'));
	}

	public function handleError($errno ,$errstr) {

		switch ($errno) {
			case E_NOTICE: return true;
		}

		throw new MoskvaException('php error with errno=' . $errno . ' (' . $errstr . ')');

		return true;
	}

	public function handleException(Exception $e) {
		$this->handleErrorException($e);
		return true;
	}

	public function handleClassNotFound($classname) {
		throw new MoskvaException($classname . ' class was not found');
	}

	private  function handleErrorException(Exception $exception) {
		print "Exception: " . $exception;
		echo '<br/>';
		echo '<pre>';
		debug_print_backtrace();
		echo '</pre>';
		exit(1);
	}

	private function loadConfig($configType) {
		$file = $this->rootDir . '/config/' . $configType . '.config.php';

		return include $file;
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