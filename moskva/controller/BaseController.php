<?php
class BaseController{
	/**
	 * @var TemplateCollection
	 */
	private $templateCollection = null;

	protected $layout = 'master';

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


	protected function getTemplateCollection() {
		if ($this->templateCollection === null) {
			$this->templateCollection = $this->buildTemplateCollection();
		}

		return $this->templateCollection;
	}

	protected function buildTemplateCollection() {
		$controller = $this->getControllerName();
		$viewsDir = Moskva::getInstance()->getViewsPath();
		$template = new TemplateCollection($viewsDir, $controller);
		$template->setNextResponsibleTemplatesCollection(new TemplateCollection(Moskva::getInstance()->getMoskvaViewsPath(), $controller));

		$template->setParentLayout($this->layout);

		return $template;
	}

    public function renderView($template,$variables=array()){
        $this->getTemplateCollection()->render($template, $variables);
    }

	public function renderPartial($template, $vars) {
		$this->getTemplateCollection()->renderPartial($template, $vars);
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

	public function redirect($url) {
		if (is_array($url)) {
			$url = call_user_func_array(array($this, 'createUrl'), $url);
		}

		header('Location: '. $url);
	}

	protected function getAdminOnlyActions() {
		return array();
	}

	protected function getAuthenticatedOnlyActions() {
		return array();
	}

	private function isActionInSet($action, $set) {
		if (!is_array($set)) {
			$set = array($set);
		}

		foreach ($set as $element) {
			if ($element === '*' || $element === $action) {
				return true;
			}
		}

		return false;
	}

	public function isAuthenticatedOnly($action) {
		return $this->isActionInSet($action, $this->getAuthenticatedOnlyActions());
	}

	public function isAdminOnly($action) {
		return $this->isActionInSet($action, $this->getAdminOnlyActions());
	}

	public function getWebUser() {
		return Moskva::getInstance()->getUser();
	}
}
