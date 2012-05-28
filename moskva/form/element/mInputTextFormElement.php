<?php
class mInputTextFormElement extends mInputFormElement {
	public function renderInput($attributes = array())
	{
		$this->renderInputTag($this->getName(), $this->getValue(), 'text', $attributes);
	}
}