<?php

abstract class mForm extends mComponent implements ArrayAccess {
	/**
	 * @var mValidator[]
	 */
	protected $validators = array();
	/**
	 * @var mFormElement[]
	 */
	protected $elements = array();

	protected $errors = array();
	private $values = array();
	protected $formName;

	public function __construct() {
		$this->formName = get_class($this);

		$this->configure();
	}

	abstract protected function configure();

	public function render() {
		foreach ($this->elements as $name => $element) {
			$element->render($this->getElementName($name), $this->getValue($name), array(), $this->getErrors($name));
			echo "<br/>";
		}
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

	public function getValues() {
		return $this->values;
	}

	public function getValue($key) {
		$values= $this->getValues();
		return isset($values[$key]) ? $values[$key] : null;
	}

	public function hasErrors($key = null) {
		if (!is_null($key)) {
			return isset($this->errors[$key]) && count($this->errors[$key]) > 0;
		}
		return count($this->errors) > 0;
	}

	public function getErrors($key) {
		return isset($this->errors[$key]) ? $this->errors[$key] : array();
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

	public function getElementName($elementName) {
		return $this->formName . '[' . $elementName . ']';
	}

	public function loadDataFromRequest() {
		$this->loadValues($_POST[$this->formName]);
	}

	public function setValue($k, $v) {
		if (isset($this->elements[$k])) {
			$this->values[$k] = $v;
		} else {
			throw new MoskvaException('there is now element with name' . $k . 'in ' . get_class($this));
		}
	}

	public function loadValues($data) {
		foreach ($data as $k => $v) {
			$this->setValue($k, $v);
		}
	}

	public function setElement($name, mFormElement $element) {
		$this->elements[$name] = $element;
	}

	public function getElement($name) {
		return $this->elements[$name];
	}

	public function addValidator(mValidator $validator) {
		$this->validators[] = $validator;
	}

	public function setAttributeValidator($element, mValidatorAttribute $validator) {
		$this->validators[$element] = $validator;
		$validator->setAttribute($element);
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