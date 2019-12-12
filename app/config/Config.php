<?php

//DB Params
define('DB_HOST', '_DB_HOST_NAME_');
define('DB_USER', '_YOUR_USER_');
define('DB_PASS', '_YOUR_PASS_');
define('DB_NAME', 'guestbook');

// Directory Separator
define('DS', DIRECTORY_SEPARATOR);

/* 
 * Application Enviroment
 * DEV  => Development
 * LIVE => Live
 * */ 
define('APPENV', 'LIVE');

// App Root
define('APPROOT', dirname(dirname(__FILE__)).DS);

// APP URL
define('APPURL', '_YOUR_APPLICATION_URL_');

// Site Name
define('SITENAME', 'GuestBook');