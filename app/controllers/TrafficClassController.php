<?php
class TrafficClassController extends CrudController{
    public function getGridColumns()
    {
        return
            array('name'=>'Класс трафика',
                  'iptables_rule'=>'Правило iptable');
    }

	protected function getEntityName() {
		return 'Классы трафика';
	}
}
