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

	public function render($vars) {
		foreach($vars as $key => $value){
			$$key = $value;
		}
		ob_start();
		include $this->fullFileName;
		$content = ob_get_clean();

		return $content;
	}
}