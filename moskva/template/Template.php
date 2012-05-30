<?php
class Template extends mComponent {
	private $collection;
	public function __construct(TemplateCollection $collection) {
		$this->collection = clone $collection;
		$this->collection->setParentLayout(null);
	}

	public function renderPartial($templateName, $vars = array(), $subDirArg = null, $collectResult = false) {
		$this->collection->renderPartial($templateName, $vars, $subDirArg, $collectResult);
	}

	public function render($fullFileName, $vars) {
		foreach($vars as $key => $value){
			$$key = $value;
		}
		ob_start();
		include $fullFileName;
		$content = ob_get_clean();

		return $content;
	}
}