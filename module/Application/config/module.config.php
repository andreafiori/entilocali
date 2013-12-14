<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                        'route'    => '/',
                        'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                               'action'     => 'index',
                        ),
                        'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                ),
            ),
                
            'application' => array( 
                            'type'    => 'segment', 
                            'options' => array( 
                                'route'    => '[/:lang][/][:category][/][:action]', 
                                'constraints' => array( 
                                    'lang'       => '[a-z]{2}',
                                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*', 
                                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',  
                                ),
                                'defaults' => array( 
                                    'controller' => 'Application\Controller\Index',
                               'action'     => 'index',
                                ), 
                            ),
                            'may_terminate' => true,
                            'child_routes' => array( 
                                'default' => array( 
                                    'type'    => 'Wildcard', 
                                    'options' => array( 
                                    ), 
                                ), 
                            ), 
                        ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
			'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
			__DIR__ . '/../view',
			__DIR__ . '/../../../public'
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
	// Doctrine
	'doctrine' => array(
			'driver' => array(
					'Application_driver' => array(
							'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
							'cache' => 'array',
							'paths' => array(__DIR__ . '/../src/Application/Entity')
					),
					'orm_default' => array(
							'drivers' => array(
									'Application\Entity' =>  'Application_driver'
							),
					),
			),
	),
);