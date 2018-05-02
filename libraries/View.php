<?php

class View {

    function __construct() {
        
    }
    public function render($filePath,$data=FALSE) {
        require 'views/'.$filePath.'.php';
    }

}