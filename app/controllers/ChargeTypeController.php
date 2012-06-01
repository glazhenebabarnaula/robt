<?php
class ChargeTypeController extends CrudController{
    public function getGridColumns()
    {
        return array('name'=>'Тип начисления',
                      'crontab_rule'=>'Правило crontab');
    }

    protected function getEntityName()
    {
        return 'Тип начисления';
    }
}
