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

	public function getMoskvaDir() {
		return $this->moskvaDir;
	}

	public function loadMoskvaParts() {
		$dirs = array('exception', 'db');

		foreach ($dirs as $dir) {
			$this->importMoskvaDir($dir);
		}

		$this->loadDoctrine();
	}

	private function getLibDir() {
		return $this->moskvaDir . '/lib';
	}

	private function loadDoctrine() {

		$this->importLibFile('doctrine/lib/Doctrine/ORM/Tools/Setup.php');
		Doctrine\ORM\Tools\Setup::registerAutoloadGit($this->getLibDir() . '/doctrine');
	}

	public function importLibFile($filename) {
		$fullPath = $this->getLibDir() . '/' . $filename;

		require_once $fullPath;
	}

	public function importMoskvaDir($dir) {
		$this->importDir($this->moskvaDir . '/' . $dir);
	}

	public function importModels($appDir) {
		$this->importDir($appDir . '/models');
	}

	public function importDir($dir){
		foreach(glob("{$dir}/*.php") as $file){
			require_once $file;
		}
	}
}
