<?php
abstract class mFormElement extends mComponent {
	protected $name;
	protected $value;
	protected $errors = array();

	public function __construct($config = array()) {
		$this->initProperties($config);
	}

	abstract public function render($attributes = array());

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