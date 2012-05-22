<?php
abstract class mInputFormElement extends mFormElement {

	protected $name;
	protected $attributes = array();
	protected $label;

	public function render($name, $value = null, $attributes = array(), $errors = array())
	{
		$this->renderLabel();
		$this->renderInput($name, $value, $attributes);
		if (count($errors) > 0) {
			$this->renderErrors($errors);
		}
	}

	public function renderLabel() {
		echo $this->label;
	}


	public function renderErrors($errors) {
		foreach ($errors as $error) {
			$this->renderError($error);
		}
	}

	protected function renderTag($tag = 'input', $content = null, $attributes = array()) {
		$attributes = array_merge($attributes, $this->attributes);

		$attributesStr = "";

		foreach ($attributes as $k => $v) {
			$attributesStr .= sprintf('%s="%s" ', $k, $v);
		}

		$attributesStr = mb_substr($attributesStr, 0, -1, 'UTF-8');

		$result = "<$tag " . $attributesStr;

		if (is_null($content)) {
			$result .= "/>";
		} else {
			$result .= ">$content</$tag>";
		}

		echo $result;
	}


	protected function renderInputTag($name, $value, $type, $attributes = array()) {
		$attributes['name'] = $name;
		$attributes['value'] = $value;
		$attributes['type'] = $type;

		return $this->renderTag('input', null, $attributes);
	}

	protected function renderError($errorMsg) {
		echo '<span class="error"> ' . $errorMsg. '</span>';
	}

	public abstract function renderInput($name, $value = null, $attributes = array());
}