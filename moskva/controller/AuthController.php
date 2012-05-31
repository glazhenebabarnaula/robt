<?php

class AuthController extends BaseController {

	public function loginAction() {
		$badAttempt = false;
		if ($this->isPostRequest()) {
			$login = $_POST['m_login'];
			$password = $_POST['m_password'];
			if (Moskva::getInstance()->getUser()->authenticate($login,$password)) {
				$this->redirect('/');
			} else {
				$badAttempt = true;
			}
		}

		$this->renderView('login', array('badAttempt' => $badAttempt));
	}

	public function logoutAction() {
		Moskva::getInstance()->getUser()->logout();
		$this->redirect(array('login'));
	}
}