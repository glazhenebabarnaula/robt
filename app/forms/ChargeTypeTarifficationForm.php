<?php
class ChargeTypeTarifficationForm extends mModelForm{
    protected function configure()
    {
        $this->setElement('charge_type',
            new mForeignKeyInputFormElement(
                array('modelName' => 'ChargeType',
                    'columns' => 'name',
                    'hasEmptyChoice' => false,
                    'label'=>'Тип начисления')
            ));
        $this->setAttributeValidator('charge_type',
            new mValidatorForeignKey(
                array('required'=>true,
                    'choices'=>array_keys($this->getElement('charge_type')->getChoices()),
                    'model'=>'ChargeType')
            ));


        $this->setElement('value', new mInputTextFormElement(array('label'=>'Размер начисления тарифа')));
        $this->setAttributeValidator('value',
            new mValidatorDecimal(array('min'=>0.0)));
    }

}
