<?php
return array(
    'modules' => array(
            'EdpModuleLayouts',
            'ServiceLocatorFactory',
            'DoctrineModule',
            'DoctrineORMModule',
            'ZendDeveloperTools',
            'ModelModule',
            'DOMPDFModule',
            'Application',
            'Admin',
            'Auth',
            'ApiWebService',
            'Feed',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);