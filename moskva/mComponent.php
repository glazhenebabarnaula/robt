<?php

class mComponent {
	public function __construct($config = array()) {
		$this->initProperties($config);
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