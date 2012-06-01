<?php
class mInputDateFormElement extends mInputTextFormElement{
	public function getValue() {
		return parent::getValue()->format('Y-m-d');
	}
}
