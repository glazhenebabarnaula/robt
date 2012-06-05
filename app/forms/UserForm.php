<?php
class UserForm extends mModelForm {
	public function configure() {
		$this->setElement('username', new mInputTextFormElement(array('label' => 'Логин')));
		$this->setAttributeValidator('username',
			new mValidatorRegex(array('regex'=>'/^[0-9A-Za-z_]+$/u',
				'regexError'=>'Допустимы только: цифры, буквы (A-Z, a-z) и символ подчёркивания (_)')));

		$this->setElement('password', new mInputTextFormElement(array('label' => 'Пароль')));
		$this->setAttributeValidator('password',
			new mValidatorRegex(array('regex'=>'/^[0-9A-Za-z\!@#\$]+$/u',
				'regexError'=>'Допустимы только: цифры, буквы (A-Z, a-z) и спец. символы (! @ # $)')));
	}
}