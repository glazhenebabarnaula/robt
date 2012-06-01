<?php
class BillIncreaseForm extends mModelForm{
    protected function configure()
    {
        $this->setElement('time', new mInputTimeFormElement('Дата и время начисления'));
        $this->setAttributeValidator('time', new mValidatorTime());

        $this->setElement('contract',
            new mForeignKeyInputFormElement(
                array('modelName' => 'Contract',
                    'columns' => 'number',
                    'hasEmptyChoice' => false,
                    'label'=>'Договор')
            ));
        $this->setAttributeValidator('contract',
            new mValidatorForeignKey(
                array('required'=>true,
                    'choices'=>array_keys($this->getElement('contract')->getChoices()),
                    'model'=>'Contract')
            ));

        $this->setElement('value', new mInputTextFormElement(array('label'=>'Размер платежа')));
        $this->setAttributeValidator('value',
            new mValidatorDecimal(array('min'=>0.0)));
    }

}
