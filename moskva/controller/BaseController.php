<?php
class BaseController{
    public function before(){}
    public function after(){}

    protected function cutSuffix($str,$suffix){
        $end = strlen($str)-strlen($suffix);
        return substr($str,0,$end);
    }

	protected function getEntityManager() {
		return Moskva::getInstance()->getEntityManager();
	}

	protected function getControllerName() {
		return $this->cutSuffix(get_class($this),'Controller');
	}

    protected function renderView($action,$variables){
        $controller = $this->getControllerName();
        $action = $this->cutSuffix($action,'Action');
        $viewsDir = Moskva::getInstance()->getViewsPath();
        $template = new Template($action, $variables, $viewsDir, $controller);
        echo $template->render();
    }

	protected function isPostRequest() {
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	public function createUrl() {
		$params = array();
		$controllerName = $this->getControllerName();
		$action = func_get_arg(0);

		if (func_num_args() === 3) {
			list($controllerName, $action, $params) = func_get_args();
		} elseif (func_num_args() === 2) {
			if (is_array(func_get_arg(1))) {
				list($action, $params) = func_get_args();
			} else {
				list($controllerName, $action) = func_get_args();
			}
		}

		$url = '/' . $controllerName . '/' . $action;

		if (count($params)) {
			$url .= '?' . http_build_query($params);
		}
		return $url;
	}

	protected function redirect($url) {
		if (is_array($url)) {
			$url = call_user_func_array(array($this, 'createUrl'), $url);
		}

		header('Location: '. $url);
	}
}
