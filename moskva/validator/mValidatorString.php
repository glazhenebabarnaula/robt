<?php

class mValidatorString extends mValidatorAttribute {
	protected $min_length = 0;
	protected $max_length = 20;

	protected $message_min = 'Длина должна быть больше';
	protected $message_max = 'Длина должна быть меньше';

	protected function cleanValue($value)
	{
		$length = mb_strlen($value, 'UTF-8');

		if ($length < $this->min_length) {
			throw new mValidationException($this->message_min);
		}

		if ($this->max_length !== null && $this->max_length < $length) {
			throw new mValidationException($this->message_max);
		}

		return $value;
	}
}