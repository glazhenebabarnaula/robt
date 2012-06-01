<?php

class ChargeTypeForm extends mModelForm {
	protected function configure()
	{
		$this->setElement('name', new mInputTextFormElement(array('label'=>'Тип начисления')));
		$this->setAttributeValidator('name', new mValidatorString());
	}
}