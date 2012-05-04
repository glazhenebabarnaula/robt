<?php
class Autoloader{
    public static  function loadControllers($controllers){
        foreach(glob("{$controllers}/*.php") as $controller){
            require_once $controller;
        }
    }
}
