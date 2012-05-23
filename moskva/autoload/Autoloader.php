<?php
class Autoloader{

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
		$dirs = array('.', 'util', 'exception', 'db', 'validator', 'validator/*', 'form', 'form/*');

		foreach ($dirs as $dir) {
			$this->importMoskvaDir($dir);
		}

		$this->loadDoctrine();
	}

	public function loadAppParts() {
		$dirs = array('components', 'controllers', 'forms', 'models');

		foreach ($dirs as $dir) {
			$this->importAppDir($dir);
		}
	}

	private function getLibDir() {
		return $this->moskvaDir . '/lib';
	}

	private function loadDoctrine() {

		$this->importLibFile('doctrine/lib/Doctrine/ORM/Tools/Setup.php');
		spl_autoload_unregister(array(Moskva::getInstance(), 'handleClassNotFound'));
		Doctrine\ORM\Tools\Setup::registerAutoloadGit($this->getLibDir() . '/doctrine');
		spl_autoload_register(array(Moskva::getInstance(), 'handleClassNotFound'));
	}

	public function importLibFile($filename) {
		$fullPath = $this->getLibDir() . '/' . $filename;

		require_once $fullPath;
	}

	public function importMoskvaDir($dir) {
		$this->importDir($this->moskvaDir . '/' . $dir);
	}

	public function importAppDir($dir) {
		$this->importDir(Moskva::getInstance()->getAppDir() . '/' . $dir);
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
