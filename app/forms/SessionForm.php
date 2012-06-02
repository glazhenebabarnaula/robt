<?php
class SessionForm extends mModelForm{
    protected function configure()
    {
        //TODO validate rule begin < end

        $this->setElement('traffic_amount',
            new mInputTextFormElement(array('label'=>'Количество трафика (в мегабайтах)')));
        $this->setAttributeValidator('traffic_amount',
            new mValidatorDecimal(array('min'=>0.0)));

        $this->setElement('begin', new mInputTimeFormElement(array('label'=>'Начало сессии')));
        $this->setAttributeValidator('begin', new mValidatorTime());

        $this->setElement('end', new mInputTimeFormElement(array('label'=>'Конец сессии')));
        $this->setAttributeValidator('end', new mValidatorTime(array('required'=>false)));


        $this->setElement('traffic_class',
            new mForeignKeyInputFormElement(
                array('modelName' => 'TrafficClass',
                      'columns' => 'name',
                      'hasEmptyChoice' => false,
                      'label'=>'Класс трафика')
                ));
        $this->setAttributeValidator('traffic_class',
            new mValidatorForeignKey(
                array('required'=>true,
                      'choices'=>array_keys($this->getElement('traffic_class')->getChoices()),
                      'model'=>'TrafficClass')
            ));
    }

}
