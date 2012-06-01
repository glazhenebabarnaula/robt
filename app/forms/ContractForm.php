<?php
class ContractForm extends mModelForm{
    protected function configure(){
        $this->setElement('first_name',new mInputTextFormElement());
        $this->setAttributeValidator('first_name',new mValidatorString());

        $this->setElement('second_name',new mInputTextFormElement());
        $this->setAttributeValidator('second_name',new mValidatorString());

        $this->setElement('number', new mInputTextFormElement());
        $this->setAttributeValidator('number', new mValidatorString());

        $this->setElement('date', new mInputDateFormElement());
        $this->setAttributeValidator('date', new mValidatorDate());

        $this->setElement('balance', new mInputTextFormElement());
        $this->setElement('balance', new mValidatorDecimal());
    }

}
