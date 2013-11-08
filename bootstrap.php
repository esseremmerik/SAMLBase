<?php

include_once('./vendor/autoload.php');

function OpenSAML_Autoload($classname) {
    $file = preg_replace('/\\\/', DIRECTORY_SEPARATOR, $classname) . '.php';
    echo $file . '<br />';
    include ($file);
}

spl_autoload_register('OpenSAML_Autoload');
