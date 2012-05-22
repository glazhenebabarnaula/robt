<?php
abstract class mFormElement extends mComponent {
	protected $name;

	public function __construct($config = array()) {
		$this->initProperties($config);
	}

	abstract public function render($name, $value = null, $attributes = array(), $errors = array());
}