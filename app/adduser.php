<?php
require_once dirname(__FILE__) . '/../moskva/Moskva.php';
Moskva::createInstance(dirname(__FILE__));
Moskva::getInstance()->init();


$user = new User();
$user->setUsername('admin');
$user->setPassword('admin');
$user->setPermissions(array('admin'));

Moskva::getInstance()->getEntityManager()->persist($user);
Moskva::getInstance()->getEntityManager()->flush();

