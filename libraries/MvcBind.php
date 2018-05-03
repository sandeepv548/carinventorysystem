<?php

class MvcBind {

    function __construct() {
       
        if (!isset($_GET['url'])) {
            $_GET['url'] = 'index/index';
        }
        $url = $_GET['url'];
        $urlArray = explode('/', $url);
        $controllerMethod = !isset($urlArray[1]) || $urlArray[1] == '' ? 'index' : $urlArray[1];

// handles the controller
        if ($controllerMethod == 'index') {
            $controller = rtrim($urlArray[0], '/');
        } else {
            $controller = $urlArray[0];
        }
        $contrFile='controllers/' . $controller . '.php';
        if(file_exists($contrFile)){
             require $contrFile;
        }else{
            throw new Exception($controller." controller doesn't exists.");
        }
       
        $controllerObj = new $controller;

// handles the method of the controller
        if (!isset($urlArray[2])) {
            $urlArray[2] = FALSE;
        }
        $controllerObj->{$controllerMethod}($urlArray[2]);
    }

}
