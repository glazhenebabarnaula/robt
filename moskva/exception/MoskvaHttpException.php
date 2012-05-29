<?php
class MoskvaHttpException extends MoskvaException {
	private $httpCode = 500;
	public function __construct($httpCode, $message = '')
	{
		$this->httpCode = $httpCode;
		parent::__construct($message);
	}

	public function getHttpCode()
	{
		return $this->httpCode;
	}
}