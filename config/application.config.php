<?php
return array(
    'modules' => array(
            'EdpModuleLayouts',
            'ServiceLocatorFactory',
            'DoctrineModule', 'DoctrineORMModule',
            //'ZendDeveloperTools',
            //'ZfcBase','ZfcUser','BjyProfiler',

            /* Apigility modules  */
            /*
            'ZF\Apigility',
            'ZF\Apigility\Provider',
            'AssetManager',
            'ZF\ApiProblem',
            'ZF\MvcAuth',
            'ZF\OAuth2',
            'ZF\Hal',
            'ZF\Configuration',
            'ZF\ContentNegotiation',
            'ZF\ContentValidation',
            'ZF\Rest',
            'ZF\Rpc',
            'ZF\Versioning',
            'ZF\DevelopmentMode',
            */

            'DOMPDFModule',
            'Application',
            'Admin',
            'ApiWebService',
            'Feed',
            'Migrazione',
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