<?php
class ChargeForm extends mModelForm{
    protected function configure(){
        $this->setElement('time',new mInputTimeFormElement(array('label'=>'Время')));
        $this->setAttributeValidator('time',new mValidatorDate());

        $this->setElement('value', new mInputTextFormElement(array('label'=>'Размер начисления')));
        $this->setAttributeValidator('value', new mValidatorDecimal());
    }

}
