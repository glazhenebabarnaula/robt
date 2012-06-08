<?php

class ChargeTypeForm extends mModelForm {
	protected function configure()
	{
		$this->setElement('name', new mInputTextFormElement(array('label'=>'Тип начисления')));
		$this->setAttributeValidator('name',
			new mValidatorRegex(array('regex'=>'/^[А-Яа-я ]+$/u',
				'regexError'=>'Эй, по-русски давай, да')));

        $this->setElement('crontab_rule', new mInputTextFormElement(array('label'=>'Правило crontab')));
        $this->setAttributeValidator('crontab_rule', new mValidatorRegex(array('required'=>false,
			'pattern' => '#^(?:(?:\*|[0-9]{1,2})/(?:\*|[0-9]{1,2})\s?){3,4}$#'
		)));
	}
}