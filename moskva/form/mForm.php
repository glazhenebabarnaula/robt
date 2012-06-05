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

	/**
	 * @var mForm[]
	 */
	protected $subForms = array();

	public function setSubForm($k, mForm $form) {
		$this->subForms[$k] = $form;
		$this->subForms[$k]->setFormName($this->getElementName($k));
		return $this;
	}

	public function getSubForm($k) {
		return $this->subForms[$k];
	}

	public function __construct() {
		$this->formName = get_class($this);

		$this->configure();
	}

	abstract protected function configure();

	public function render($menuStyle = false) {
		$result = "";
		foreach ($this->subForms as $subForm) {
			$result .= $subForm->render($menuStyle);
		}

		foreach ($this->elements as $name => $element) {
			if ($menuStyle) {
				$result .= "<li>";
			}
			$result .= $element->render(array());
			if ($menuStyle) {
				$result .= "</li>";
			} else {
				$result .= "<br/>";
			}
		}

		return $result;
	}

	private function addError($k, $message) {
		if (ctype_digit($k)) {
			$this->errors[] = $message;
		} else {
			if (!isset($this->errors[$k])) {
				$this->errors[$k] = array();
			}
			$this->elements[$k]->addError($message);
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

		foreach ($this->elements as $e) {
			$e->clearErrors();
		}

		foreach ($this->validators as $k => $validator) {
			try {
				$values = $validator->cleanValues($values);
			}
			catch (mGeneralValidatorException $e) {
				$this->addError($e->getElementName(), $e->getMessage());
			}
			catch (mValidationException $e) {
				$this->addError($k, $e->getMessage());
			}
		}

		$wasInvalidSubForm = false;
		foreach ($this->subForms as $k => $form) {
			$wasInvalidSubForm |= !$form->validate();
			$this->values[$k] = $form->getValues();
		}

		$this->values = $values;

		return !$this->hasErrors() && !$wasInvalidSubForm;
	}

	public function getElementName($elementName) {
		return $this->formName . '[' . $elementName . ']';
	}

	public function loadDataFromRequest() {
		$this->loadValues($_POST[$this->formName]);
	}

	public function setValue($k, $v) {
		if (isset($this->elements[$k]) && isset($this->validators[$k])) {
			$this->values[$k] = $v;
			$this->elements[$k]->setValue($v);
		} elseif(isset($this->subForms[$k])) {
			$this->getSubForm($k)->loadValues($v);
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
		$element->setName($this->getElementName($name));
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
		isset($this->elements[$offset]) || isset($this->subForms[$offset]);
	}

	public function offsetGet($offset)
	{
		return (isset($this->subForms[$offset]) ? $this->subForms[$offset] : $this->getElement($offset));
	}

	public function offsetSet($offset, $value)
	{
		throw new MoskvaException("read only field");
	}

	public function offsetUnset($offset)
	{
		throw new MoskvaException("read only field");
	}

	public function setFormName($formName)
	{
		$this->formName = $formName;

		foreach ($this->elements as $name => $element) {
			$element->setName($this->getElementName($name));
		}

		foreach ($this->subForms as $name => $subForm) {
			$subForm->setFormName($this->getElementName($name));
		}
	}
}