<?php

class mComponent {
	protected $requiredOptions = array();

	public function __construct($config = array()) {
		foreach ($this->requiredOptions as $option) {
			if (!in_array($option, array_keys($config))) {
				throw new MoskvaException('option ' . $option . ' is required in ' . get_class($this));
			}
		}

		$this->initProperties($config);

		$this->init();
	}

	protected function init() {

	}

	protected function initProperties($config) {
		foreach ($config as $k => $v) {
			if (property_exists(get_class($this), $k)) {
				$this->$k = $v;
			} else {
				throw new MoskvaException('property ' . $k. ' doesnt exist in class' . get_class($this));
			}
		}
	}
}