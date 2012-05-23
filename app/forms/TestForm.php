<?php

class TestForm extends mModelForm {
	protected function configure()
	{
		$this->setElement('value', new mInputTextFormElement());

		$this->setAttributeValidator('value', new mValidatorString(array('min_length' => 4)));
	}
}