<?php
class ContractController extends CrudController {
	public function getGridColumns()
	{
		return array('first_name' => 'Имя',
                      'second_name'=>'Фамилия',
					  'number' => 'Номер',
					  'tariff' => 'Тариф',
					   'balance' => 'Баланс');
	}

	protected function getEntityName()
	{
		return 'Договоры';
	}

}