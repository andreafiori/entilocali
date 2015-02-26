<?php

//ob_start('compressHTMLOutput');

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
// chdir(dirname(__DIR__));
chdir( __DIR__ );

define('REQUEST_MICROTIME', microtime(true));
ini_set("display_errors",true);

// increase max execution time for some operation (i.e: )
ini_set('max_execution_time', 3600);

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

/* compress HTML output */
//ob_end_flush();
function compressHTMLOutput($buffer)
{
    $bufferout = $buffer;
    $bufferout = str_replace("\n", "", $bufferout);
    $bufferout = str_replace("\t", "", $bufferout);
    $bufferout = preg_replace('/<!--(.|\s)*?-->/', '', $bufferout);
    return $bufferout;
}