<?php

class mWebUser extends mComponent {
	const sessionIdKeyName = 'web_user_id';
	protected $id = null;
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $em = null;
	protected $requiredOptions = array('em');

	protected $model = null;

	protected function init() {
		session_start();
		if (isset($_SESSION[self::sessionIdKeyName])) {
			$this->id = $_SESSION[self::sessionIdKeyName];
			$this->model = $this->em->getRepository('\Moskva\User\Model\User')->find($this->id);
		}
	}

	protected function login($id) {
		$this->id = $id;
		$_SESSION[self::sessionIdKeyName] = $this->id;
	}

	public function isAuthenticated() {
		return $this->id != null;
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * @return \Moskva\User\Model\User
	 */
	public function getModel() {
		return $this->model;
	}

	public function authenticate($username, $password) {
		/**
		 * @var $user \Moskva\User\Model\User
		 */
		$user = $this->em->getRepository('\Moskva\User\Model\User')->findOneBy(array('username' => $username, 'password' => $password));

		if ($user === null) {
			return false;
		}

		$this->login($user->getId());
		$this->model = $user;

		return true;
	}

	public function logout() {
		$this->id = null;
		unset($_SESSION[self::sessionIdKeyName]);
	}
}