<?php
class mInputTextFormElement extends mInputFormElement {
	public function renderInput($name, $value = null, $attributes = array())
	{
		$this->renderInputTag($name, $value, 'text', $attributes);
	}
}