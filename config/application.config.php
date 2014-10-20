<?php
return array(
    'modules' => array(
            'EdpModuleLayouts',
            'ServiceLocatorFactory',
            'DoctrineModule', 'DoctrineORMModule',
            'ZendDeveloperTools',
            //'ZfcBase','ZfcUser','BjyProfiler',
            'Application',
            'Admin',
            'ApiWebService',
            'Feed',
            'Migrazione',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor','./module',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);