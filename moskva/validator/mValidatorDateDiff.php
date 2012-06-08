<?php
class mValidatorDateDiff extends mValidator
{
	protected $date1 = '';
	protected $date2 = '';
	protected $errorMsg = '';

	public function __construct($config = array()) {
		parent::__construct($config);
	}

	public function cleanValues($values)
	{
		$earlyDateExists = isset($values[$this->date1])
			&& ($values[$this->date1] instanceof DateTime);
		$laterDateExists = isset($values[$this->date2])
			&& ($values[$this->date2] instanceof DateTime);
		if($earlyDateExists && $laterDateExists)
		{
			if($values[$this->date1] > $values[$this->date2])
			{
				throw new mGeneralValidatorException($this->errorMsg, $this->date2);
			}
		}
		return $values;
	}
}
