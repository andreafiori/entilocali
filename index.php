<?php

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

chdir( __DIR__ );

define('REQUEST_MICROTIME', microtime(true));
// ini_set("display_errors", true);
ini_set("upload_max_filesize", '150M');
ini_set("post_max_size", '150M');

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// disable DOMPDF's internal autoloader if you are using Composer
define('DOMPDF_ENABLE_AUTOLOAD', false);

// set default timezone to prevent date warning \ error\s
date_default_timezone_set('Asia/Manila');

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
