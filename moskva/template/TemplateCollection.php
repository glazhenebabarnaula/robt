<?php
class TemplateCollection{
    private $parentLayout,
            $subDir,
            $viewsDir;

	/**
	 * @var TemplateCollection
	 */
	private $nextResponsibleTemplatesCollection = null;
	private $rootCollection = null;

    /*If controllerName is NULL, template will be evaluated as layout
     * */
    public function __construct($viewsDir, $subDir = null){
        $this->subDir = $subDir;
        $this->viewsDir = $viewsDir;
		$this->rootCollection = $this;
    }

    public function __get($name){
        if(array_key_exists($name,$this->variables)){
            return $this->variables[$name];
        }
        else{
            return '';
        }
    }

    public function __set($name, $value){
        $this->variables[$name] = $value;
    }

    public function setParentLayout($parentName){
        $this->parentLayout = $parentName;
    }

	public function renderPartial($templateName, $vars = array(), $subDirArg = null, $collectResult = false) {
		$subDir = $subDirArg;
		if (!$subDir) {
			$subDir = $this->subDir;
		}

		$fullFileName = $this->viewsDir . '/' . $subDir . '/' . $templateName . '.php';


		if (!file_exists($fullFileName)) {
			if ($this->nextResponsibleTemplatesCollection !== null) {
				$content = $this->nextResponsibleTemplatesCollection->renderPartial($templateName, $vars, $subDirArg, true);
			} else {
				throw new MoskvaNotFoundViewException($fullFileName);
			}
		} else {
			$template = new Template($this->rootCollection, $fullFileName);
			$content = $template->render($vars);
		}

		if (!$collectResult) {
			echo $content;
		}

		return $content;
	}

    public function render($template, $vars, $subDir = null, $collectResult = false){
        $content = $this->renderPartial($template, $vars, $subDir, true);

        if(!empty($this->parentLayout)){
			$parent = $this->parentLayout;
			$this->parentLayout = null;
            return $this->render($parent, array('content' => $content), 'layouts', $collectResult);
        }

		if (!$collectResult) {
			echo $content;
		}

        return $content;
    }

	/**
	 * @param \TemplateCollection $nextResponsibleTemplatesCollection
	 */
	public function setNextResponsibleTemplatesCollection($nextResponsibleTemplatesCollection)
	{
		if ($nextResponsibleTemplatesCollection !== null) {
			$nextResponsibleTemplatesCollection->setNextResponsibleTemplatesCollection($this->nextResponsibleTemplatesCollection);
			$nextResponsibleTemplatesCollection->rootCollection = $this->rootCollection;
		}
		$this->nextResponsibleTemplatesCollection = $nextResponsibleTemplatesCollection;
	}
}
