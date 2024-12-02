<?php
spl_autoload_register(function ($class) {
    // Prefix to look for in the namespace
    $prefix = 'App\\';

    // Base directory for the App namespace
    $baseDir = __DIR__ . '/App/';

    // Check if the class uses the App namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // If the class doesn't use the App namespace, do nothing
        return;
    }

    // Replace the namespace prefix with the base directory
    $relativeClass = substr($class, $len);

    // Replace the namespace separators with directory separators
    $relativeClass = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass);

    // Create the full path to the class file
    $file = $baseDir . $relativeClass . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});
