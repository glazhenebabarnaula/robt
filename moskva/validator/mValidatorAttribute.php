<?php
abstract class mValidatorAttribute extends mValidator {
	protected $attribute;

	protected $message_required = 'Необходимо заполнить поле';
	protected $required = true;

	public function __construct($attribute, $config) {
		parent::__construct();
		$this->attribute = $attribute;

		foreach ($config as $k => $v) {
			if (property_exists(get_class($this), $k)) {
				$this->$k = $v;
			}
		}
	}

	protected function cleanValues($values)
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
}