<?php
return array(
    'router' => array(
                    'routes' => array(
                                    'home' => array(
                                                    'type' => 'Zend\Mvc\Router\Http\Literal',
                                                    'options' => array(
                                                                    'route'    => '/',
                                                                    'defaults' => array(
                                                                                    'controller' => 'Application\Controller\Index',
                                                                                    'action'     => 'index',
                                                                    ),
                                                    ),
                                    ),
                                    'main' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route'    => '/[:category][/][:title][/]',
                                                                    'constraints' => array(
                                                                            'category'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                            'title'     => '[a-zA-Z0-9_-]*',
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
                                    'feed' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route'    => '/feed/rss',
                                                                    'constraints' => array(
                                                                        
                                                                    ),
                                                                    'defaults' => array(
                                                                                    'controller' => 'Application\Controller\Feed',
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
                                    'version' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route'    => '/documenti/versione[/][:tipo][/][:categoria][/][:id]',
                                                                    'constraints' => array(
                                                                        
                                                                    ),
                                                                    'defaults' => array(
                                                                                    'controller' => 'Application\Controller\DocumentExport',
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
                                    'foto' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/foto[/][:action]',
                                                        'constraints' => array(
                                                            
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'    => 'index',
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
                                    'albo-pretorio' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/albo-pretorio[/][:action]',
                                                        'constraints' => array(
                                                            
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'    => 'index', 
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
                                    'amministrazione-aperta' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/amministrazione-aperta[/][:action]',
                                                        'constraints' => array(
                                                            
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'    => 'index', 
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
                                    'amministrazione-trasparente' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/amministrazione-trasparente[/][:action]',
                                                        'constraints' => array(
                                                            
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'    => 'index', 
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
                                    'contatti' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/invia-messaggi/contatti[/][:action]',
                                                        'constraints' => array(
                                                            
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'    => 'index',
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
                                    'form-response' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/form/response[/][:formname]',
                                                        'constraints' => array(
                                                            
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'    => 'index',
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
                        'Application\Controller\Index'             => 'Application\Controller\IndexController',
                        'Application\Controller\DocumentExport'    => 'Application\Controller\DocumentExportController',
                        'Application\Controller\Feed'              => 'Application\Controller\FeedController',
                    ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'CommonSetupPlugin' => 'Application\Controller\Plugin\CommonSetupPlugin'
        )
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
                                    'admin/index'             => __DIR__ . '/../view/',
                                    'error/404'               => __DIR__ . '/../view/error/404.phtml',
                                    'error/index'             => __DIR__ . '/../view/error/index.phtml',
                                    'error/dbconnection'      => __DIR__ . '/../view/error/dbconnection.phtml',
                    ),
                    'template_path_stack' => array(
                                    __DIR__ . '/../view',
                                    __DIR__ . '/../../../public'
                    ),
    ),
    // Placeholder for console routes
    'console' => array(
                    'router' => array(
                                'routes' => array(  ),
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