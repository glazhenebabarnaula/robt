<?php
class mValidatorDate extends mValidatorAttribute{
    protected function cleanValue($value){
        $date = date_create($value);
        if(!$date){
            throw new mValidationException('Неправильный формат даты');
        }

        return $date;
    }

}
