<?php
abstract class mInputFormElement extends mFormElement {

	protected $name;
	protected $attributes = array();
	protected $label;

	protected function getIdByName() {
		return preg_replace('/\[\]/', '_', $this->getName());
	}

	public function render($attributes = array())
	{
		$id = isset($attributes['id']) ? $attributes['id'] : $this->getIdByName();
		$attributes['id'] = $id;

		$label = $this->renderLabel($attributes);
		$input = $this->renderInput($attributes);
		$errors = "";

		if (count($this->errors) > 0) {
			$errors = $this->renderErrors();
		}

		return $label . $input . $errors;
	}

	public function renderLabel($attributes = array()) {
		$id = isset($attributes['id']) ? $attributes['id'] : $this->getIdByName();;
		$result = $this->renderTag('label', $this->label ? $this->label : '', array('for' => $id));
		return $result;
	}


	public function renderErrors() {
		$result = "";
		foreach ($this->getErrors() as $error) {
			$result .= $this->renderError($error);
		}
		return $result;
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

		return $result;
	}


	protected function renderInputTag($name, $value, $type, $attributes = array()) {
		$attributes['name'] = $name;
		$attributes['value'] = $value;
		$attributes['type'] = $type;

		return $this->renderTag('input', null, $attributes);
	}

	protected function renderError($errorMsg) {
		return $this->renderTag('span', $errorMsg, array('class' => 'error'));
	}

	public abstract function renderInput($attributes = array());
}