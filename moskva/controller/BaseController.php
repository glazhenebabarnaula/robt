<?php
class BaseController{
    public function before(){}
    public function after(){}

    protected function cutSuffix($str,$suffix){
        $end = strlen($str)-strlen($suffix);
        return substr($str,0,$end);
    }

    protected function renderView($action,$variables){
        $controller = $this->cutSuffix(get_called_class(),'Controller');
        $action = $this->cutSuffix($action,'Action');
        $viewsDir = Moskva::getInstance()->getViewsPath();
        $template = new Template($action, $variables, $viewsDir, $controller);
        echo $template->render();
    }
}
