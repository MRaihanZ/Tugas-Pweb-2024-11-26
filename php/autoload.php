<?php
spl_autoload_register(function ($class) {
    $prefix = 'App\\';

    $baseDir = __DIR__ . '/App/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);

    $relativeClass = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass);

    $file = $baseDir . $relativeClass . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
