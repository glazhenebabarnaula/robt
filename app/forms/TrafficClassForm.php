<?php
class TrafficClassForm extends mModelForm{
    protected function configure(){
        $this->setElement('name', new mInputTextFormElement());
        $this->setAttributeValidator('name', new mValidatorString());

        $this->setElement('iptables_rule', new mInputTextFormElement());
        $this->setAttributeValidator('iptables_rule', new mValidatorString());
    }
}
