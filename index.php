<?php

// Sandeep's MVC
$base_url='https://sandeepv548.github.io/carinventorysystem/';
define('_BASE_URL_', $base_url);
define('_BASE_DIR_',__DIR__);

$includes = array('helpers', 'libraries');
foreach ($includes as $rootDir) {
    $filesArray = glob($rootDir . '/*');
    foreach ($filesArray as $filePath) {
        if (file_exists($filePath)) {
            require $filePath;
        }else{
            throw new Exception($filePath." file does'nt exists");
        }
    }
} 

$app = new MvcBind();
?>