<?php

class TestForm extends mModelForm {
	protected function configure()
	{
		$this->setElement('value', new mInputTextFormElement());

		$this->setAttributeValidator('value', new mValidatorString(array('min_length' => 4)));

		$this->setElement('charge_type_id', new mForeignKeyInputFormElement(array('modelName' => 'ChargeType', 'columns' => 'name')));

		$this->setAttributeValidator('charge_type_id',
			new mValidatorChoice(
				array('choices' => array_keys($this->getElement('charge_type_id')->getChoices()))
			)
		);
	}
}