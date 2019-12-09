<?php

//DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'guestbook');

// Directory Separator
define('DS', DIRECTORY_SEPARATOR);

/* 
 * Application Enviroment
 * DEV  => Development
 * LIVE => Live
 * */ 
define('APPENV', 'DEV');

// App Root
define('APPROOT', dirname(dirname(__FILE__)).DS);

// URL Root
define('APPURL', 'http://localhost'.DS.'guestbook'.DS);

// Site Name
define('SITENAME', 'GuestBook');