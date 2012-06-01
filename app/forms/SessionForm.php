<?php
class SessionForm extends mModelForm{
    protected function configure()
    {
        //TODO validate rule begin < end

        $this->setElement('traffic_amount', new mInputTextFormElement());
        $this->setAttributeValidator('traffic_amount',
            new mValidatorDecimal(array('min'=>0.0)));

        $this->setElement('begin', new mInputTimeFormElement());
        $this->setAttributeValidator('begin', new mValidatorTime());

        $this->setElement('end', new mInputTimeFormElement());
        $this->setAttributeValidator('end', new mValidatorTime(array('required'=>false)));

        $this->setElement('cost', new mInputTextFormElement());
        $this->setAttributeValidator('cost', new mValidatorDecimal(array('min'=>0.0)));

        $this->setElement('contract',
            new mForeignKeyInputFormElement(
                array('modelName' => 'Contract',
                      'columns' => 'number',
                      'hasEmptyChoice' => false)
                ));

        $this->setAttributeValidator('contract',
            new mValidatorForeignKey(
                array('required'=>true,
                      'choices'=>array_keys($this->getElement('contract')->getChoices()),
                      'model'=>'Contract')
                ));

        $this->setElement('traffic_class',
            new mForeignKeyInputFormElement(
                array('modelName' => 'TrafficClass',
                      'columns' => 'name',
                      'hasEmptyChoice' => false)
                ));
        $this->setAttributeValidator('traffic_class',
            new mValidatorForeignKey(
                array('required'=>true,
                      'choices'=>array_keys($this->getElement('traffic_class')->getChoices()),
                      'model'=>'TrafficClass')
            ));
    }

}
