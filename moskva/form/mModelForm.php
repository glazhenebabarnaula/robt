<?php
abstract class mModelForm extends mForm {
	protected $model;
	public function __construct($model, $config = array()) {
		$this->model = $model;

		parent::__construct($config);

		$this->updateValuesFromModel();
	}

	public function getModel() {
		return $this->model;
	}

	protected function methodSuffix($field) {
		return mInflector::classify($field);
	}

	protected function getterName($field) {
		return 'get' . $this->methodSuffix($field);
	}

	protected function setterName($field) {
		return 'set' . $this->methodSuffix($field);
	}

	public function updateModel() {
		if (!$this->validate()) {
			return false;
		}

		foreach ($this->subForms as $form) {
			if ($form instanceof mModelForm) {
				$form->updateModel();
			}
		}

		$values = $this->getValues();

		foreach ($values as $k => $v) {
			$this->model->{$this->setterName($k)}($v);
		}

		return true;
	}

	public function updateValuesFromModel() {
		foreach ($this->subForms as $form) {
			if ($form instanceof mModelForm) {
				$form->updateValuesFromModel();
			}
		}
		foreach (array_keys($this->elements) as $k) {
			if (method_exists(get_class($this->model), $this->getterName($k))) {
				$this->setValue($k, $this->model->{$this->getterName($k)}());
			}
		}
	}
}