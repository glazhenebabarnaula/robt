<?php
class mValidatorDecimal extends mValidatorAttribute{
    protected $min = null;
    protected $max = null;

    protected function cleanValue($value){
        if(!is_numeric($value)){
            throw new mValidationException('Неправильный формат числа');
        }

        $fval = floatval($value);

        if($this->min !== null){
            if($fval < $this->min){
                throw new mValidationException('Число должно быть больше ' . $this->min);
            }
        }
        if($this->max !== null){
            if($fval > $this->max){
                throw new mValidationException('Число должно быть меньше ' . $this->max);
            }
        }

        return $fval;
    }

}
