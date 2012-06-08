<?php
class UserForm extends mModelForm {
	public function configure() {
		$this->setElement('username', new mInputTextFormElement(array('label' => 'Логин')));
		$this->setAttributeValidator('username',new mValidatorRegexp(array('pattern' => '/^[a-zA-Z0-9_]+$/')));

		$this->setElement('password', new mInputTextFormElement(array('label' => 'Пароль','attributes' => array('type' => 'password'))));
		$this->setAttributeValidator('password',  new mValidatorString());
	}
}