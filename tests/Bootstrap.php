<?php

use ModelModuleTest\ServiceManagerGrabber;

error_reporting(E_ALL | E_STRICT);

$cwd = __DIR__;
chdir(dirname(__DIR__));

// Assume we use composer
$loader = require_once  './vendor/autoload.php';
$loader->add("AdminTest\\", $cwd);
$loader->add("ApiWebServiceTest\\", $cwd);
$loader->add("ApplicationTest\\", $cwd);
$loader->add("AuthTest\\", $cwd);
$loader->add("ModelModuleTest\\", $cwd);
$loader->add("ServiceLocatorFactoryTest\\", $cwd);
$loader->register();

ServiceManagerGrabber::setServiceConfig(require_once './config/application.config.php');
ob_start();