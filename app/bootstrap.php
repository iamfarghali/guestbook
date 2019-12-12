<?php
// Load Config
require_once 'config/Config.php';

// Load url functions
require_once APPROOT.'helper'.DS.'helper_fns.php';

// Start session && Load session functions
require_once APPROOT.'helper'.DS.'session_fn.php';

// Autoloading classes
spl_autoload_register(function($class) {
    if (file_exists(APPROOT.'libs'.DS.$class.'.php')) {
        require_once 'libs'.DS.$class.'.php';
    } elseif (file_exists(APPROOT.'models'.DS.$class.'.php')) {
        require_once 'models'.DS.$class.'.php';
    }
});