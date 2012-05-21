<?php

abstract class mForm implements ArrayAccess {
	protected $model;
	/**
	 * @var mValidator[]
	 */
	protected $validators = array();
	protected $elements = array();
	protected $errors = array();
	protected $values = array();
	protected $formName;

	public function __construct($model) {
		$this->model = $model;
		$this->formName = get_class($this);

		$this->configure();
	}

	abstract protected function configure();

	public function render() {

	}

	private function addError($k, $message) {
		if (ctype_digit($k)) {
			$this->errors[] = $message;
		} else {
			if (!isset($this->errors[$k])) {
				$this->errors[$k] = array();
			}
			$this->errors[$k][] = $message;
		}

	}

	public function hasErrors() {
		return count($this->errors) > 0;
	}

	public function getErrors($key) {
		return $this->errors[$key];
	}

	public function getGlobalErrors() {
		$result = array();

		foreach ($this->errors as $k => $v) {
			if (ctype_digit($k)) {
				$result[] = $v;
			}
		}

		return $result;
	}

	public function validate() {
		$values = $this->values;

		foreach ($this->validators as $k => $validator) {
			try {
				$values = $validator->cleanValues($values);
			} catch (mValidationException $e) {
				$this->addError($k, $e->getMessage());
			}
		}

		return !$this->hasErrors();
	}

	public function loadDataFromRequest() {
		$this->loadData($_POST[$this->formName]);
	}

	public function loadData($data) {
		foreach ($data as $k => $v) {
			if (isset($this->elements[$k])) {
				$this->values[$k] = $v;
			}
		}
	}

	public function offsetExists($offset)
	{
		isset($this->elements[$offset]);
	}

	public function offsetGet($offset)
	{
		return $this->offsetGet($offset);
	}

	public function offsetSet($offset, $value)
	{
		$this->elements[$offset] = $value;
	}

	public function offsetUnset($offset)
	{
		unset($this->elements[$offset]);
	}
}