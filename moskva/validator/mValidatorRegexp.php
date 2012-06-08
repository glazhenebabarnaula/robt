<?php

class mValidatorRegexp extends mValidatorString{

	protected $pattern = null;

	protected $requiredOptions = array('pattern');

	protected function cleanValue($value)
	{
		$value = parent::cleanValue($value);

		$matched = preg_match($this->pattern, $value);
		if(!$matched){
			throw new mValidationException('Неверный формат');
		}

		return $value;
	}

}