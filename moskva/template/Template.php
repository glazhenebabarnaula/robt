<?php
class Template{
    private $variables,
            $child,
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

    public function setChild($content){
        $this->child = $content;
    }

    public function render(){
        ob_start();
        foreach($this->variables as $key => $value){
            $$key = $value;
        }
        if(!is_null($this->controller)){
            include $this->viewsDir . $this->controller . '/' . $this-> templateName . '.php';
        }
        else{
            include $this->viewsDir . 'layouts/' . $this->templateName . '.php';
        }
        $content = ob_get_clean();
        if(isset($this->parentLayout)){
            $parent = new Template($this->parentLayout, $this->variables, $this->viewsDir);
            $parent->setChild($content);
            return $parent->render();
        }
        return $content;
    }

    private function renderChild(){
        if(isset($this->child)){
            echo $this->child;
        }
    }

    private function renderPartial($controller, $name){
        include $this->viewsDir . $controller . '/' . $name . '.php';
    }
}
