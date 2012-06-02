<?php
class ChargeForm extends mModelForm{
    protected function configure(){
        $this->setElement('time',new mInputTimeFormElement(array('label'=>'Время')));
        $this->setAttributeValidator('time',new mValidatorDate());

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
    }

}
