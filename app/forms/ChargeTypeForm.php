<?php

class ChargeTypeForm extends mModelForm {
	protected function configure()
	{
		$this->setElement('name', new mInputTextFormElement(array('label'=>'Тип начисления')));
		$this->setAttributeValidator('name', new mValidatorString());

        $this->setElement('crontab_rule', new mInputTextFormElement(array('label'=>'Правило crontab')));
        $this->setAttributeValidator('crontab_rule', new mValidatorString(array('required'=>false)));
	}
}