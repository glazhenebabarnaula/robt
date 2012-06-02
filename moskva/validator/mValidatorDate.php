<?php
class mValidatorDate extends mValidatorAttribute{
    protected function cleanValue($value){
		if ($value instanceof DateTime) {
			return $value;
		}

		if (empty($value)) {
			return null;
		}

        $date = date_create($value);
        if(!$date){
            throw new mValidationException('Неправильный формат даты');
        }

        return $date;
    }

}
