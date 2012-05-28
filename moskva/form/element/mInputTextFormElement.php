<?php
class mInputTextFormElement extends mInputFormElement {
	public function renderInput($attributes = array())
	{
		return $this->renderInputTag($this->getName(), $this->getValue(), 'text', $attributes);
	}
}