<?php
class mValidatorDecimal extends mValidatorAttribute{
    protected function cleanValue($value){
        if(!is_numeric($value)){
            throw new mValidationException('Неправильный формат числа');
        }

        return floatval($value);
    }

}
