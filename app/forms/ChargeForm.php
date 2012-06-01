<?php
class ChargeForm extends mModelForm{
    protected function configure(){
        $this->setElement('time',new mInputTimeFormElement());
        $this->setAttributeValidator('time',new mValidatorDate());

        $this->setElement('value', new mInputTextFormElement());
        $this->setAttributeValidator('value', new mValidatorDecimal());
    }

}
