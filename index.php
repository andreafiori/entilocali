<?php

// ob_start('sanitize_output');

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
// chdir(dirname(__DIR__));
chdir( __DIR__ );

define('REQUEST_MICROTIME', microtime(true));
// ini_set("display_errors", true);

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
function sanitize_output($buffer)
{
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}