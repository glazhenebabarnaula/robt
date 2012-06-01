<?php
class mValidatorName extends mValidatorString{
    protected $min_length = 5;

    protected function cleanValue($value)
    {
        $value = parent::cleanValue($value);

        $matched = preg_match('/^[\p{L}]+$/u', $value);
        if(!$matched){
            throw new mValidationException('В имени должны быть только буквы');
        }

        return $value;
    }

}
