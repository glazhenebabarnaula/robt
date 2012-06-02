<?php
class BillIncreaseForm extends mModelForm{
    protected function configure()
    {
        $this->setElement('time', new mInputTimeFormElement(array('label'=>'Дата и время начисления')));
        $this->setAttributeValidator('time', new mValidatorTime());

        $this->setElement('value', new mInputTextFormElement(array('label'=>'Размер платежа')));
        $this->setAttributeValidator('value',
            new mValidatorDecimal(array('min'=>0.0)));
    }

}
