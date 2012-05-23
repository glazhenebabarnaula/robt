<?php
class MainPage{
    public function index(){
		$test = new Test();
		$test->setValue("test");
		Moskva::getInstance()->getEntityManager()->persist($test);
		Moskva::getInstance()->getEntityManager()->flush();

		$tests = Moskva::getInstance()->getEntityManager()->getRepository('Test')->findAll();

		print_r($tests);
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
