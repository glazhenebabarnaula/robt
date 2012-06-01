<?php
class ContractController extends CrudController {
	public function getGridColumns()
	{
		return array('first_name' => 'Имя');
	}

	protected function getEntityName()
	{
		return 'Договора';
	}

}