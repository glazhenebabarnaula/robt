<?php
class MainPageController{
    public function indexAction(){
		$test = new Test();
		$test->setValue("test");
		Moskva::getInstance()->getEntityManager()->persist($test);
		Moskva::getInstance()->getEntityManager()->flush();

		$tests = Moskva::getInstance()->getEntityManager()->getRepository('Test')->findAll();

		print_r($tests);
	}

	public function login() {
		if (Moskva::getInstance()->getUser()->isAuthenticated()) {
			echo "already: " . Moskva::getInstance()->getUser()->getModel()->getUsername();
			die();
		}
		var_dump(Moskva::getInstance()->getUser()->authenticate('sufix', '472120'));
	}

	public function logout() {
		var_dump(Moskva::getInstance()->getUser()->logout());
	}

	public function testForm() {
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
}
