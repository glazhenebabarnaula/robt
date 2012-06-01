<?php
class TariffForm extends mModelForm{

    protected function configure(){
        $this->setElement('name',new mInputTextFormElement(array('label'=>'Название тарифа')));
        $this->setAttributeValidator('name',new mValidatorString());
    }
}
