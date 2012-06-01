<?php
class TrafficClassForm extends mModelForm{
    protected function configure(){
        $this->setElement('name', new mInputTextFormElement(array('label'=>'Название класса трафика')));
        $this->setAttributeValidator('name', new mValidatorString());

        $this->setElement('iptables_rule',
            new mInputTextFormElement(array('label'=>'Правило iptable')));
        $this->setAttributeValidator('iptables_rule', new mValidatorString());
    }
}
