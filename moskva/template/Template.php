<?php
class Template extends mComponent {
	private $collection;
	private $fullFileName;
	public function __construct(TemplateCollection $collection, $fullFileName) {
		$this->collection = clone $collection;
		$this->collection->setParentLayout(null);
		$this->fullFileName = $fullFileName;
	}

	public function renderPartial($templateName, $vars = array(), $subDirArg = null, $collectResult = false) {
		$this->collection->renderPartial($templateName, $vars, $subDirArg, $collectResult);
	}

	public function setParentLayout($parent) {
		$this->collection->setParentLayout($parent);
	}

	public function render($vars) {
		foreach($vars as $key => $value){
			$$key = $value;
		}
		ob_start();
		include $this->fullFileName;
		$content = ob_get_clean();

		return $content;
	}

	public function getController() {
		return Moskva::getInstance()->getController();
	}

	public function createUrl() {
		$args = func_get_args();
		return call_user_func_array(array($this->getController(), 'createUrl'), $args);
	}

	public function getControllerVar($k, $v = null) {
		return $this->getController()->getVar($k, $v);
	}

	public function setControllerVar($k, $v) {
		$this->getController()->setVar($k, $v);
	}

	public function getWebUser() {
		return Moskva::getInstance()->getUser();
	}
}