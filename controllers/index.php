<?php

//Index controller

class Index extends Controller{

    function __construct() {
        parent:: __construct();
    }
    public function index() {
         //$this->view->msg="this is not";
         $this->view->render('index');
    }

}

