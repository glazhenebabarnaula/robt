<?php

class ChargeTypeForm extends mModelForm {
	protected function configure()
	{
		$this->setElement('name', new mInputTextFormElement());
		$this->setAttributeValidator('name', new mValidatorString());
	}
}