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


	private $appDir;

	/**
	 * @var \Doctrine\DBAL\Driver\Connection
	 */
	private $db;
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $entityManager;

	private $isDebug = true;
	private $isInitialized = false;
	/**
	 * @var mWebUser
	 */
	protected $user = null;

	/**
	 * @var BaseController
	 */
	private $controller = null;

	private function __construct($dir) {
		set_error_handler(array($this, 'handleError'));
		set_exception_handler(array($this, 'handleException'));
		spl_autoload_register(array(Autoloader::getInstance(), 'tryLoadClass'));
		spl_autoload_register(array($this, 'handleClassNotFound'));
		error_reporting(E_ALL);
		ini_set('display_errors', true);
		$this->appDir = $dir;

		//$this->init();
	}

	public function isDebug() {
		return $this->isDebug;
	}

	private function initDb() {

		Autoloader::getInstance()->importModels($this->appDir);
		$doctrineConfigurator = new DoctrineConfigurator();

		$this->db = $doctrineConfigurator->createConnection($this->loadConfig('database'));
		$this->entityManager = $doctrineConfigurator->createEntityManager($this->db, $this->appDir);
	}

	public function init() {
		if ($this->isInitialized) {
			return false;
		}

		Autoloader::getInstance()->loadMoskvaParts();
		Autoloader::getInstance()->loadAppParts();

		$this->initDb();

		$this->user = new mWebUser(
								array_merge(
									$this->loadConfig('user'),
									array('em' => $this->getEntityManager())
								)
					);

		$this->isInitialized = true;

		return true;
	}

	public function handleError($errno ,$errstr) {

		switch ($errno) {
			//case E_NOTICE: return true;
		}

		$this->handleException(new MoskvaException('php error with errno=' . $errno . ' (' . $errstr . ')'));

		return true;
	}

	public function handleException(Exception $e) {
		if ($e instanceof MoskvaHttpException) {
			header('HTTP/1.0 ' .$e->getHttpCode() . '');
			die();
		}

		$this->handleErrorException($e);
		return true;
	}

	public function handleClassNotFound($classname) {
		if (class_exists($classname)) {
			return true;
		}
		//throw new MoskvaException($classname . ' class was not found');
		return false;
	}

	private  function handleErrorException(Exception $exception) {
		print "Exception: " . $exception->getMessage();
		echo '<div style="width: 500px;"><br/>';
		echo '<pre>';
		//array_walk( debug_backtrace(), create_function( '$a,$b', 'print "<br /><b>". basename( $a[\'file\'] ). "</b> &nbsp; <font color=\"red\">{$a[\'line\']}</font> &nbsp; <font color=\"green\">{$a[\'function\']} ()</font> &nbsp; -- ". dirname( $a[\'file\'] ). "/";' ) );
		debug_print_backtrace();
		echo '</pre></div>';
		exit(1);
	}

	public function loadConfig($configType) {
		$file = $this->appDir . '/config/' . $configType . '.config.php';

		return include $file;
	}

    public function getViewsPath() {
        $file = $this->getAppDir() . '/views';

        return $file;
    }

	public function getMoskvaViewsPath() {
		return Autoloader::getInstance()->getMoskvaDir() . '/views';
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
                    $this->handleError('400','not enough parameters in url');
                    exit();
                }
            }
        }
        return $argsInRequest;
    }

	public function handleHttpRequest() {
		$this->init();

		$requestedUri = $_SERVER['REQUEST_URI'];
        $router = new Router();
        $routeArray = $router->resolveUrl($requestedUri);
        $controller = $routeArray['controller'];
        $action = $routeArray['action'];

		$controllerClassName = $controller . 'Controller';
		$actionMethodName = $action . 'Action';

        if(class_exists($controllerClassName)){
			/**
			 * @var $instance BaseController
			 */

            $instance = new $controllerClassName();
			$this->controller = $instance;
            if(method_exists($instance, $actionMethodName)){

				if ($instance->isAuthenticatedOnly($action) && !$this->user->isAuthenticated()) {
					$instance->redirect(array('Auth','login'));
				}

				if ($instance->isAdminOnly($action) && !$this->user->getModel()->hasAccess('admin')) {
					throw new MoskvaHttpException(403);
				}

                $args = $this->getArgumentsOfAction($controllerClassName,$actionMethodName);
                $instance->$actionMethodName($args);
                exit();
            }
        }
        throw new MoskvaHttpException(404);
    }

	public function handleDoctrineCommand() {
		$this->init();
		DoctrineCommand::createInstance()->run();
	}

	public function getDb()
	{
		return $this->db;
	}

	public function getEntityManager()
	{
		return $this->entityManager;
	}

	public function getAppDir()
	{
		return realpath($this->appDir);
	}

	/**
	 * @return \mWebUser
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return \BaseController
	 */
	public function getController()
	{
		return $this->controller;
	}
}