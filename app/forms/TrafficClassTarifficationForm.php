<?php
class TrafficClassTarifficationForm extends mModelForm{
    protected function configure()
    {
        $this->setElement('traffic_class',
            new mForeignKeyInputFormElement(
                array('modelName' => 'TrafficClass',
                    'columns' => 'name',
                    'hasEmptyChoice' => false,
                    'label'=>'Класс тафика')
            ));
        $this->setAttributeValidator('traffic_class',
            new mValidatorForeignKey(
                array('required'=>true,
                    'choices'=>array_keys($this->getElement('traffic_class')->getChoices()),
                    'model'=>'TrafficClass')
            ));
        $this->setElement('minute_cost', new mInputTextFormElement(array('label'=>'Стоимость минуты')));
        $this->setAttributeValidator('minute_cost', new mValidatorDecimal(array('min'=>0.0)));

        $this->setElement('megabyte_cost', new mInputTextFormElement(array('label'=>'Стоимость мегабайта')));
        $this->setAttributeValidator('megabyte_cost', new mValidatorDecimal(array('min'=>0.0)));
    }
}
