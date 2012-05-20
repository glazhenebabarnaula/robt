<?php

class DoctrineConfigurator {

	public function createConnection($params) {
		return \Doctrine\DBAL\DriverManager::getConnection($params, new \Doctrine\DBAL\Configuration());
	}

	public function createEntityManager(\Doctrine\DBAL\Connection $connection, $appDir) {
		$modelsDirs = array(Autoloader::getInstance()->getMoskvaDir() . '/models', $appDir . '/models');

		$config = new \Doctrine\ORM\Configuration();
		$config->setMetadataDriverImpl($config->newDefaultAnnotationDriver($modelsDirs));
		$config->setProxyDir($appDir . '/cache/proxies');
		$config->setProxyNamespace('App\Proxies');

		$config->setAutoGenerateProxyClasses(true);

		$em = \Doctrine\ORM\EntityManager::create($connection, $config);

		return $em;
	}
}