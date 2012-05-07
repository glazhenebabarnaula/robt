<?php
    require_once '../moskva/Moskva.php';

    Moskva::createInstance('../app');
    Moskva::getInstance()->handleHttpRequest();
?>