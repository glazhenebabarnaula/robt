<?php
class MainPageController extends BaseController {

	protected function getAuthenticatedOnlyActions()
	{
		return array('*');
	}

	protected function getAdminOnlyActions() {
		return array('showAdminPanel');
	}

	public function showAdminPanelAction() {
		$this->renderView('showAdminPanel');
	}

	public function indexAction() {
		if ($this->getWebUser()->getModel()->hasAccess('admin')) {
			$this->redirect(array('MainPage', 'showAdminPanel'));
		}

		$this->renderView('index');
	}
}
