<?php
require_once dirname(__FILE__) . '/../moskva/Moskva.php';
Moskva::createInstance(dirname(__FILE__));
Moskva::getInstance()->handleDoctrineCommand();

