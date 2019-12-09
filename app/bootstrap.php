<?php
// Load Config
require_once 'config/Config.php';

// Load data filter functions
require_once APPROOT.'helper'.DS.'filter_data_fn.php';

// Load url functions
require_once APPROOT.'helper'.DS.'url_fn.php';

// Load session functions
require_once APPROOT.'helper'.DS.'session_fn.php';

// Autoloading classes
spl_autoload_register(function($class) {
    if (file_exists(APPROOT.'libs'.DS.$class.'.php')) {
        require_once 'libs'.DS.$class.'.php';
    } elseif (file_exists(APPROOT.'models'.DS.$class.'.php')) {
        require_once 'models'.DS.$class.'.php';
    }
});