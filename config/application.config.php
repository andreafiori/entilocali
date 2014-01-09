<?php
return array(

    'modules' => array(
        'Application',
    	'EdpModuleLayouts', 'ServiceLocatorFactory',
    	'DoctrineModule', 'DoctrineORMModule',
    	'ZendDeveloperTools', 'BjyProfiler',
    	'Backend','Categories','Config','Contacts','Frontend','Languages','Posts','Setup',
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