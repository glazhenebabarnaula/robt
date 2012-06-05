<?php
class TariffForm extends mModelForm{

    protected function configure(){
        $this->setElement('name',new mInputTextFormElement(array('label'=>'Название тарифа')));
        $this->setAttributeValidator('name',
			new mValidatorRegex(array('regex'=>'/^[0-9A-Za-zА-Яа-я_@ ]+$/u','regexError'=>'Допустимы только:цифры, английские и русские буквы,_,@,знак пробела')));
    }
}
