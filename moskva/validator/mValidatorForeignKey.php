<?php
class mValidatorForeignKey extends mValidatorChoice {
	protected $model;

	public function init() {
		if ($this->model === null) {
			throw new MoskvaException('option ' . 'model' . ' is required in ' . get_class($this));
		}
	}

	protected function cleanValue($value)
	{
		if ($value instanceof $this->model) {
			return $value;
		}

		$value = parent::cleanValue($value);

		return Moskva::getInstance()->getEntityManager()->find($this->model, $value);
	}


}