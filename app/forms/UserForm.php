<?php
class UserForm extends mModelForm {
	public function configure() {
        //TODO username validator
		$this->setElement('username', new mInputTextFormElement(array('label'=>'Имя пользователя')));
		$this->setAttributeValidator('username', new mValidatorString());

		$this->setElement('password', new mInputTextFormElement(array('label'=>'Пароль')));
		$this->setAttributeValidator('password', new mValidatorString());
	}
}