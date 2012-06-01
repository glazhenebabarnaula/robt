<?php
class UserForm extends mModelForm {
	public function configure() {
		$this->setElement('username', new mInputTextFormElement(array('label' => 'Логин')));
		$this->setAttributeValidator('username', new mValidatorString());

		$this->setElement('password', new mInputTextFormElement(array('label' => 'Пароль')));
		$this->setAttributeValidator('password', new mValidatorString());
	}
}