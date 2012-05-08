<?php
class Autoloader{
    public static  function loadControllers($controllers){
        foreach(glob("{$controllers}/*.php") as $controller){
            require_once $controller;
        }
    }

	private static $_instance = null;

	/**
	 * @static
	 * @return Autoloader
	 */
	public static function getInstance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new Autoloader();
		}
		return self::$_instance;
	}

	private $moskvaDir;
	private function __construct() {
		$this->moskvaDir = dirname(dirname(__FILE__));
	}

	public function loadMoskvaParts() {
		$dirs = array('db', 'exception');

		foreach ($dirs as $dir) {
			$this->importMoskvaDir($dir);
		}
	}


	public function importMoskvaDir($dir) {
		$this->importDir($this->moskvaDir . '/' . $dir);
	}

	public function importDir($dir){
		foreach(glob("{$dir}/*.php") as $file){
			require_once $file;
		}
	}
}
