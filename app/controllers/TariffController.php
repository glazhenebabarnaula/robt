<?php
class TariffController extends CrudController {
	public function getGridColumns()
	{
		return array('name' => 'Название');
	}

	protected function getEntityName()
	{
		return 'Тарифы';
	}

}