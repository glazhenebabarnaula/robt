<?php
class Template{
    private $variables,
            $parentLayout,
            $templateName,
            $controller,
            $viewsDir;

    /*If controllerName is NULL, template will be evaluated as layout
     * */
    public function __construct($name, $vars, $views, $controllerName=NULL){
        $this->templateName = $name;
        $this->variables = $vars;
        $this->controller = $controllerName;
        $this->viewsDir = $views;
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

	private function renderFile($fileName, $vars = array()) {
		foreach($vars as $key => $value){
			$$key = $value;
		}

		$fullFileName = $this->viewsDir . '/' . $fileName . '.php';

		if (!file_exists($fullFileName)) {
			throw new MoskvaNotFoundViewException($fullFileName);
		}

		ob_start();
		include $fullFileName;
		$content = ob_get_clean();

		return $content;
	}

    public function render(){
        if(!is_null($this->controller)){
            $content = $this->renderFile($this->controller . '/' . $this-> templateName, $this->variables);
        }
        else{
            $content = $this->renderFile('layouts/' . $this->templateName, $this->variables);
        }

        if(isset($this->parentLayout)){
			if (!($this->parentLayout instanceof Template)) {
            	$parent = new Template($this->parentLayout, array(), $this->viewsDir);
			} else {
				$parent = $this->parentLayout;
			}
			/**
			 * @var $parent Template
			 */
			$parent->setVariable('content', $content);
            return $parent->render();
        }

        return $content;
    }

    public function renderPartial($name, $vars = array(), $controller = null){
		if ($controller === null) {
			$controller = $this->controller;
		}
        echo $this->renderFile($controller . '/' . $name, $vars);
    }
}
