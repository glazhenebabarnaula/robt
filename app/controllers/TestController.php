<?php
class TestController extends CrudController {
	public function getGridColumns()
	{
		return array('value' => 'Значение',  'fk' => 'Внешний ключ - круто!');
	}

}