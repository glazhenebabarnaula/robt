<?php
class mInputDateFormElement extends mInputTextFormElement{
	public function getValue() {
        $value = parent::getValue();
        if(!($value instanceof DateTime)){
            return $value;
        }
		return $value->format('Y-m-d');
	}
}
