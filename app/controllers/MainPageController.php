<?php
class MainPageController extends BaseController{
    public function indexAction(){
        echo $this->renderView('index',array('indexMethodVar'=>'<p>Moskva slezam ne verit'));
	}

	public function loginAction() {
		if (Moskva::getInstance()->getUser()->isAuthenticated()) {
			echo "already: " . Moskva::getInstance()->getUser()->getModel()->getUsername();
			die();
		}
		var_dump(Moskva::getInstance()->getUser()->authenticate('sufix', '472120'));
	}

	public function logoutAction() {
		var_dump(Moskva::getInstance()->getUser()->logout());
	}

	public function testFormAction() {
		$form = new TestForm(new Test());

		if (isset($_POST['TestForm'])) {
			$form->loadDataFromRequest();

			if ($form->validate()) {
				$form->updateModel();
				Moskva::getInstance()->getEntityManager()->persist($form->getModel());
				Moskva::getInstance()->getEntityManager()->flush();
				echo "form is OK<br/>";
				print_r($form->getValues());
				$tests = Moskva::getInstance()->getEntityManager()->getRepository('Test')->findAll();

				print_r($tests);
				die();
			}
		}

		echo "<html><body><form method='POST'> ";
				$form->render() ;
		echo "		<input type='submit'/>
			</form></body></html>";
	}

	protected function getAuthenticatedOnlyActions()
	{
		return array('*');
	}

	protected function getAdminOnlyActions()
	{
		return array('*');
	}
}
