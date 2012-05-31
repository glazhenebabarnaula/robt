<?php

class TestForm extends mModelForm {
	protected function configure()
	{
		$this->setElement('value', new mInputTextFormElement());

		$this->setAttributeValidator('value', new mValidatorString(array('min_length' => 4)));

		$this->setElement('charge_type', new mForeignKeyInputFormElement(array('modelName' => 'ChargeType', 'columns' => 'name', 'hasEmptyChoice' => true)));

		$this->setAttributeValidator('charge_type',
			new mValidatorForeignKey(
				array(
					'required' => false,
					'choices' => array_keys($this->getElement('charge_type')->getChoices()),
					'model' => 'ChargeType',
				)
			)
		);
	}
}