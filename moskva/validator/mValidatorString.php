<?php

class mValidatorString extends mValidatorAttribute {
	protected $min_length = 0;

	protected $message_min = 'Длина должна быть больше';

	protected function cleanValue($value)
	{
		$length = mb_strlen($value);

		if ($length < $this->min_length) {
			throw new mValidationException($this->message_min);
		}

		return $value;
	}
}