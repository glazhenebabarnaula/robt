<?php

class mDbQuery {
	private $selectExpr;
	private $fromTable;
	private $joins = array();
	private $insertTable = array();
	private $updateTable = array();
	private $condition = "";
	private $values;

	private $sql = "";


	/**
	 * @var PDO
	 */
	private $pdo = null;
	/**
	 * @var PDOStatement
	 */
	private $pdoStatement = null;

	public function __construct(PDO $pdo, $sql = null) {
		$this->pdo = $pdo;

		$this->sql = $sql;
	}

	private function buildSql() {
		if (is_null($this->sql)) {
			$this->doBuildSql();
			$this->pdoStatement = null;
		}
	}

	/**
	 * should be abstract for different database using
	 */
	private function doBuildSql() {
		if ($this->selectExpr) {
			$this->doBuildSelectSql();
			return;
		}

		if ($this->updateTable) {
			$this->doBuildUpdateSql();
		}
	}

	private function getWhereExpression() {
		return 'WHERE ' . $this->condition;
	}

	private function doBuildSelectSql() {
		$this->sql = "SELECT " . $this->selectExpr . ' ' . $this->fromTable . ' '. $this->joins;
		$this->sql .= $this->getWhereExpression();
	}

	private function doBuildUpdateSql() {
		$setString = "";
		foreach ($this->values as $k => $v) {
			if (!empty($setString)) {
				$setString = ", ";
			}
			$setString .= "$k = $v";
		}

		$this->sql = "UPDATE " . $this->updateTable . ' SET ' . $setString . ' '. $this->joins;
		$this->sql .= $this->getWhereExpression();
	}

	private function doBuildInsertSql() {
		$columns = implode(', ', array_keys($this->values));
		$values = implode(', ', array_values($this->values));

		$this->sql = "INSERT INTO " . $this->insertTable . ' (' . $columns . ')  VALUES('. $values . ')';
	}

	private function markSqlAsDirty() {
		$this->sql = null;
	}

	private function buildPDOStatement() {
		$this->buildSql();

		if (is_null($this->pdoStatement)) {
			$this->pdoStatement = $this->pdo->prepare($this->sql);
		}
	}

	public function execute($params = null) {
		$this->buildPDOStatement();

		if (!empty($params)) {
			$this->bindParams($params);
		}

		return $this->pdoStatement->execute();
	}

	public function bindParams($params) {
		foreach ($params as $param => $value) {
			$this->bindValue($param, $value);
		}
	}

	public function bindValue($param, $value) {
		$this->pdoStatement->bindValue($param, $value);
	}

	public function fetchAll($params = null) {
		if ($this->execute($params)) {
			return $this->pdoStatement->fetchAll();
		}

		return null;
	}

	public function fetchRow($params = null) {
		if ($this->execute($params)) {
			if ($this->pdoStatement->rowCount() == 0) {
				return null;
			}
			return $this->pdoStatement->fetch();
		}

		return null;
	}

	public function fetchSingleScalar($params = null) {
		if ($this->execute($params)) {
			if ($this->pdoStatement->rowCount() == 0) {
				return null;
			}
			return $this->pdoStatement->fetchColumn();
		}

		return null;
	}

	public function select($selectExpr) {
		$this->markSqlAsDirty();
		$this->selectExpr = $selectExpr;
		$this->insertTable = null;
		$this->updateTable = null;

		return $this;
	}

	public function from($table) {
		$this->markSqlAsDirty();
		$this->fromTable = $table;

		return $this;
	}

	public function join($join, $type = 'INNER JOIN') {
		$this->markSqlAsDirty();
		if (empty($this->joins)) {
			$this->joins = "";
		}

		$this->joins .= $type . ' ' . $join;
		return $this;
	}

	public function where($condition) {
		$this->markSqlAsDirty();
		$this->condition = $condition;
		return $this;
	}

	public function addCondition($condition, $operator = 'AND') {
		$this->markSqlAsDirty();
		$condition = '(' . $condition .')';
		if (empty($this->condition)) {
			$this->condition = $condition;
		} else {
			$this->condition .= ' '. $operator . ' ' . $condition;
		}
		return $this;
	}

	public function values($values) {
		$this->markSqlAsDirty();

		$this->values = $values;

		return $this;
	}

	public function update($table, $values) {
		$this->markSqlAsDirty();
		$this->selectExpr = null;
		$this->insertTable = null;
		$this->updateTable = $table;

		return $this->values($values);
	}

	public function insert($table, $values) {
		$this->markSqlAsDirty();
		$this->selectExpr = null;
		$this->updateTable = null;
		$this->insertTable = $table;

		return $this->values($values);
	}
}