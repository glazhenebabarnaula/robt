<?php
class ContractForm extends mModelForm{
    protected function configure(){
        $this->setElement('first_name',new mInputTextFormElement(array('label' => 'Имя')));
        $this->setAttributeValidator('first_name',
			new mValidatorRegex(array('regex'=>'/^[{L}]+$/u','regexError'=>'В имени должны быть только буквы')));

        $this->setElement('second_name',new mInputTextFormElement(array('label' => 'Фамилия')));
        $this->setAttributeValidator('second_name',
			new mValidatorRegex(array('regex'=>'/^[{L}]+$/u','regexError'=>'В фамилии должны быть только буквы')));

        $this->setElement('number', new mInputTextFormElement(array('label' => 'Номер договора')));
        $this->setAttributeValidator('number',
			new mValidatorRegex(array('regex'=>'/^[0-9A-Za-z_]+$/u','regexError'=>'Допустимы только:цифры, английские буквы и _')));

        $this->setElement('date', new mInputDateFormElement(array('label' => 'Дата заключения')));
        $this->setAttributeValidator('date', new mValidatorDate());

		$this->setElement('tariff', new mForeignKeyInputFormElement(array('modelName' => 'Tariff', 'columns' => 'name', 'label' => 'Тариф')));

		$this->setAttributeValidator('tariff',
			new mValidatorForeignKey(
				array(
					'required' => false,
					'choices' => array_keys($this->getElement('tariff')->getChoices()),
					'model' => 'Tariff',
				)
			)
		);

  		$this->setSubForm('user', new UserForm($this->getModel()->getUser()));
    }

}
