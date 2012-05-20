<?php
class DoctrineCommand {
	public function run() {
		$conn = Moskva::getInstance()->getDb();
		$em = Moskva::getInstance()->getEntityManager();

		$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
			'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($conn),
			'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
		));

		\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet);
	}

	public static function createInstance() {
		return new DoctrineCommand();
	}
}