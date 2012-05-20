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
}
