<?php
class mDbConnection {

	/**
	 * @var PDO
	 */
	private $pdo = null;

	public function __construct($config) {
		foreach (array('connectionString', 'user', 'password') as $parameter) {
			if (!isset($config[$parameter])) {
				throw new MoskvaException("$parameter should be specified in config/database.config.php");
			}
		}

		$this->pdo = new PDO($config['connectionString'], $config['user'], $config['password']);
	}

	private function divideParamsAndValues($values) {
		$newValues = array();
		$params = array();
		foreach ($values as $k => $v) {
			$paramName = ':'.$k;
			$newValues[$k] = $paramName;
			$params[$paramName] = $v;
		}

		return array($newValues, $params);
	}

	public function insert($table, $values) {
		list($columns, $params) = $this->divideParamsAndValues($values);
		return $this->createQuery()->insert($table, $columns)->execute($params);
	}

	public function update($table, $values, $condition) {
		list($columns, $params) = $this->divideParamsAndValues($values);
		return $this->createQuery()->update($table, $columns)->where($condition)->execute($params);
	}

	public function createQuery($sql = null) {
		return new mDbQuery($this->pdo, $sql);
	}
}