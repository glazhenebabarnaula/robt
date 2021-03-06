<?php
class mInputTimeFormElement extends mInputTextFormElement{
    public function getValue() {
        $value = parent::getValue();
        if(!($value instanceof DateTime)){
            return '';
        }
        return $value->format('Y-m-d H:i');
    }
}
