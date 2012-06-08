<?php
class mValidatorRegex extends mValidatorString
{
	protected $regex = '';
	protected $regexError = '';

	/**
	 * @param string $value
	 */
	protected function cleanValue($value)
	{
		parent::cleanValue($value);

		$matched = preg_match($this->regex, $value);

		if(!$matched)
		{
			throw new mValidationException($this->regexError);
		}

		return $value;
	}
}
