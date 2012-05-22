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
		$form = new TestForm();

		if (isset($_POST['TestForm'])) {
			$form->loadDataFromRequest();
			if ($form->validate()) {
				echo "form is OK<br/>";
				print_r($form->getValues());
				die();
			}
		}

		echo "<html><body><form method='POST'> ";
				$form->render() ;
		echo "		<input type='submit'/>
			</form></body></html>";
	}
}
