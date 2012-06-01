<?php
class UserForm extends mModelForm {
	public function configure() {
		$this->setElement('username', new mInputTextFormElement());
		$this->setAttributeValidator('username', new mValidatorString());

		$this->setElement('password', new mInputTextFormElement());
		$this->setAttributeValidator('password', new mValidatorString());
	}
}