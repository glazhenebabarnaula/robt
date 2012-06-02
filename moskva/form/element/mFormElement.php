<?php
abstract class mFormElement extends mComponent {
	protected $name;
	protected $value;
	protected $errors = array();
	protected $attributes = array();

	abstract public function render($attributes = array());

	protected function getAttributes($attributes = array()) {
		return array_merge($this->attributes, $attributes);
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function addError($error) {
		$this->errors[] = $error;
	}

	public function clearErrors() {
		$this->errors = array();
	}

	public function getErrors()
	{
		return $this->errors;
	}
}