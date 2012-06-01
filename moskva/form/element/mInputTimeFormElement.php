<?php
class mInputTimeFormElement extends mInputTextFormElement{
    public function getValue() {
        return parent::getValue()->format('hh:mm');
    }
}
