<?php
class mValidatorChoice extends mValidatorAttribute {
	protected $requiredOptions = array('choices');

	protected $choices = array();

	protected function cleanValue($value)
	{
		if (empty($value)) {
			return null;
		}
		$choices = $this->getChoices();
		$key = array_search($value, $choices);

		if ($key === false) {
			throw new mValidationException($this->message);
		}

		return $choices[$key];
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