<?php

class Moskva {

	/**
	 * @var $_instance Moskva
	 */
	private static $_instance = null;
	public static function createInstance($rootDir) {
		//
		$config = include('');
	}

	/**
	 * @static
	 * return Moskva
	 */
	public static function getInstance() {
		return self::$_instance;
	}

	public function handleHttpRequest() {
		echo "Moskva slezam ne verit";
	}

}