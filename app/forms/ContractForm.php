<?php
class ContractForm extends mModelForm{
    protected function configure(){
        $this->setElement('first_name',new mInputTextFormElement(array('label'=>'Имя')));
        $this->setAttributeValidator('first_name',new mValidatorString());

        $this->setElement('second_name',new mInputTextFormElement(array('label'=>'Фамилия')));
        $this->setAttributeValidator('second_name',new mValidatorString());

        $this->setElement('number', new mInputTextFormElement(array('label'=>'Номер договора')));
        $this->setAttributeValidator('number', new mValidatorString());

        $this->setElement('date', new mInputDateFormElement(array('label'=>'Номер договора')));
        $this->setAttributeValidator('date', new mValidatorDate());

        //$this->setElement('balance', new mInputTextFormElement());
        //$this->setAttributeValidator('balance', new mValidatorDecimal());

		$this->setSubForm('user', new UserForm($this->getModel()->getUser()));
    }

}
