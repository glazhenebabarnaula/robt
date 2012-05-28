<?php

abstract class mValidatorAttribute extends mValidator {
	protected $attribute;

	protected $message_required = 'Необходимо заполнить поле';
	protected $required = true;

	protected $message;

	public function __construct($config = array()) {
		parent::__construct($config);
	}



	public function cleanValues($values)
	{
		$value = $values[$this->attribute];

		$cleanedValue = $this->doCleanValue($value);

		$values[$this->attribute] = $cleanedValue;

		return $values;
	}

	protected function doCleanValue($value) {
		if ($this->required && empty($value)) {
			throw new mValidationException($this->message_required);
		}

		return $this->cleanValue($value);
	}

	abstract protected function cleanValue($value);

	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;
	}
}