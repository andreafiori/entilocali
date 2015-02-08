<?php
return array(
    'router' => array(
                    'routes' => array(
                                    'home' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route' => '/',
                                                    ),
                                                    'may_terminate' => true,
                                                    'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'     => 'index',
                                                    ),
                                    ),
                                    'main' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route' => '/[:category][/][:title][/]',
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
                                    ),
                                    'contents' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route' => '/contents/node/[:subsectionid[/]]',
                                                                    'constraints' => array(
                                                                            'subsectionid' => '[0-9]+',
                                                                    ),
                                                                    'defaults' => array(
                                                                            'controller' => 'Application\Controller\Index',
                                                                            'action'     => 'index',
                                                                    ),
                                                    ),
                                                    'may_terminate' => true,
                                    ),
                                    'css' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route'    => '/css/styeleswitch/[:cssname[/]]',
                                                                    'constraints' => array(
                                                                            'cssname'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                    ),
                                                                    'defaults' => array(
                                                                            'controller' => 'Application\Controller\Index',
                                                                            'action'     => 'index',
                                                                    ),
                                                    ),
                                                    'may_terminate' => true,
                                    ),
                                    'posts' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route'    => '/[:category][/]page[/][:page][/]',
                                                                    'constraints' => array(
                                                                            'category'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                            'page'      => '[0-9]+',
                                                                    ),
                                                                    'defaults' => array(
                                                                            'controller' => 'Application\Controller\Index',
                                                                            'action'     => 'index',
                                                                    ),
                                                    ),
                                                    'may_terminate' => true,
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
                                    'faq' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/faq/domande[/][:action]',
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
                                                            'options' => array( ),
                                                        ),
                                        ),
                                    ),
                                    'albo-pretorio' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/albo-pretorio/atti/elenco[/][page/:page[/]]',
                                                        'constraints' => array(
                                                            'page' => '[0-9]+',
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
                                                            'options' => array(),
                                                        ),
                                        ),
                                    ),
                                    'stato-civile' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/stato-civile/pubblicazioni/elenco[/][page/:page[/]]',
                                                        'constraints' => array(
                                                            'page'      => '[0-9]+',
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
                                                        'route'    => '/amministrazione-trasparente/articoli/elenco/[:profondita[/]]',
                                                        'constraints' => array(
                                                            'profondita'  => '[0-9]+',
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
                                    'atti-concessione' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/atti-concessione/atti/elenco[/][page/:page[/]]',
                                                        'constraints' => array(
                                                            'page'      => '[0-9]+',
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
                                    'contratti-pubblici' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/contratti-pubblici/bandi-e-contratti/elenco[/][page/:page[/]]',
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
                                                        'route'    => '/contatti/invia-messaggio[/][:action[/]]',
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
                                    'newsletter' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/newsletter[/]',
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
                                    'registrati' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/registrazione/form[/]',
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
                                    'recupero-password' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/recupero-password[/]',
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
                                    'registrazione' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/registrati[/]',
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
                                    'ricerca' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/ricerca/risultati[/][:action][/]',
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
                    'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
                    'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
                    'abstract_factories' => array(
                               'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
                               'Zend\Log\LoggerAbstractServiceFactory',
                    ),
                    'aliases' => array(
                                'translator' => 'MvcTranslator',
                    ),
                    'factories' => array(
                        
                    ),
    ),
    'translator' => array(
                    'locale' => 'it_IT',
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
                                    'application/feed/index'  => __DIR__ . '/../view/application/index/index.phtml',
                                    'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
                                    'application/pagination'  => __DIR__ . '/../view/application/pagination/numbers.phtml',
                                    'admin/index'             => __DIR__ . '/../view/',
                                    'error/404'               => __DIR__ . '/../view/error/404.phtml',
                                    'error/index'             => __DIR__ . '/../view/error/index.phtml',
                                    'error/dbconnection'      => __DIR__ . '/../view/error/dbconnection.phtml',
                    ),
                    'template_path_stack' => array(
                                    __DIR__ . '/../view',
                                    __DIR__ . '/../../../public'
                    ),
                    'strategies' => array(
                        
                        'ViewJsonStrategy',
                        'ViewFeedStrategy',
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
    // Frontend Router Class Map. The PostsFrontend will handle the home page
    'fe_router' => array(
        "default"                       => 'Application\Model\Posts\PostsFrontend',
        "home"                          => 'Application\Model\Posts\PostsFrontend',
        "contents"                      => 'Application\Model\Contenuti\ContenutiFrontend',
        "css"                           => 'Application\Model\CssStyleSwitch\CssStyleSwitchFrontend',
        "albo-pretorio"                 => 'Application\Model\AlboPretorio\AlboPretorioFrontend',
        "amministrazione-trasparente"   => 'Application\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFrontend',
        "atti-concessione"              => 'Application\Model\AttiConcessione\AttiConcessioneFrontend',
        "contatti"                      => 'Application\Model\Contacts\ContactsFrontend',
        "contratti-pubblici"            => 'Application\Model\ContrattiPubblici\ContrattiPubbliciFrontend',
        "faq"                           => 'Application\Model\Faq\FaqFrontend',
        "foto"                          => 'Application\Model\Posts\PhotoFrontend',
        "newsletter"                    => 'Application\Model\Newsletter\NewsletterFrontend',
        "registrazione"                 => 'Application\Model\Users\RegistrationFrontend',
        "recupero-password"             => 'Application\Model\Users\RecoverPasswordFrontend',
        "ricerca"                       => 'Application\Model\Ricerca\RicercaFrontend',
        "stato-civile"                  => 'Application\Model\StatoCivile\StatoCivileFrontend',
    )
);
