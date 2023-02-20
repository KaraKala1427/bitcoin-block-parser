<?php

spl_autoload_register(function($className) {
    $file = dirname(__FILE__) . '\\' . $className . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
//    echo $file."\n";
    if (file_exists($file)) {
        include $file;
    }
});