<?php
    spl_autoload_register(function($class) {
        $prefix = 'App\\';
        $baseDir = __DIR__ . '/';

        $len = strlen($prefix);
        if(strncmp($prefix, $class, $len) !== 0) {
            return;
        }
        $file = $baseDir . str_replace('\\', '/', substr($class, $len)) . '.php';
        if(file_exists($file)) {
            require($file);
        }
    });
