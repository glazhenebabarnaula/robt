<?php
class mValidatorChoice extends mValidatorAttribute {
	protected $requiredOptions = array('choices');

	protected $choices = array();

	protected function cleanValue($value)
	{

		$value = array_search($value, $this->getChoices());

		if ($value === false) {
			throw new mValidationException($this->message);
		}

		return $value;
	}

	public function setChoices($choices)
	{
		$this->choices = $choices;
	}

	public function getChoices()
	{
		return $this->choices;
	}

}