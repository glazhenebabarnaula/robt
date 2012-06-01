<?php
class ChargeTypeTarifficationForm extends mModelForm{
    protected function configure()
    {
        $this->setElement('charge_type',
            new mForeignKeyInputFormElement(
                array('modelName' => 'ChargeType',
                    'columns' => 'name',
                    'hasEmptyChoice' => false,
                    'label' => 'Тип начислений')
            ));
        $this->setAttributeValidator('charge_type',
            new mValidatorForeignKey(
                array('required'=>true,
                    'choices'=>array_keys($this->getElement('charge_type')->getChoices()),
                    'model'=>'ChargeType')
            ));

        $this->setElement('tariff',
            new mForeignKeyInputFormElement(
                array('modelName' => 'Tariff',
                    'columns' => 'name',
                    'hasEmptyChoice' => false,
                    'label' => 'Тариф')
            ));
        $this->setAttributeValidator('tariff',
            new mValidatorForeignKey(
                array('required'=>true,
                    'choices'=>array_keys($this->getElement('tariff')->getChoices()),
                    'model'=>'Tariff')
            ));

        $this->setElement('value',
            new mInputTextFormElement(array('label'=>'Размер начисления по тарифу')));
        $this->setAttributeValidator('value',
            new mValidatorDecimal(array('min'=>0.0)));
    }

}
