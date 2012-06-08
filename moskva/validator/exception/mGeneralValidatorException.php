<?php
class mGeneralValidatorException extends  mValidationException
{
	private $element;

	public function __construct($message = "", $element, $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->element = $element;
	}

	public function getElementName()
	{
		return $this->element;
	}
}
