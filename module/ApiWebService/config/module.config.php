<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ApiWebService\Controller\AlboPretorioApi'  => 'ApiWebService\Controller\AlboPretorioApiController',
            'ApiWebService\Controller\ApiWebService'    => 'ApiWebService\Controller\DefaultApiController',
            'ApiWebService\Controller\SetupApi'         => 'ApiWebService\Controller\SetupApiController',
            'ApiWebService\Controller\PostsApi'         => 'ApiWebService\Controller\PostsApiController',
            'ApiWebService\Controller\UtentiApi'        => 'ApiWebService\Controller\UtentiApiController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'ApiWebService-main' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/api/v1[/]',
                    'constraints' => array(
                    	
                    ),
                    'defaults' => array(
                        'controller' => 'ApiWebService\Controller\ApiWebService',
                    	'action' => 'index'
                    ),
                ),
            	'may_terminate' => true,
            	'child_routes' => array(
            		'setup' => array(
            			'type'    => 'Segment',
            			'options' => array(
            				'route'    => '[/]setup[/:action][/]',
            				'constraints' => array(

            				),
            				'defaults' => array(
            					'controller'    => 'ApiWebService\Controller\SetupApi',
            					'action'        => 'index'
            				),
            			),
            		),
                        'posts' => array(
            			'type'    => 'Segment',
            			'options' => array(
            				'route'    => '[/]posts[/:action][/]',
            				'constraints' => array(
            					
            				),
            				'defaults' => array(
            					'controller' => 'ApiWebService\Controller\PostsApi',
            					'action' 	 => 'index'
            				),
            			),
            		),
                        'albo-pretorio' => array(
            			'type'    => 'Segment',
            			'options' => array(
            				'route'    => '[/]albo-pretorio[/:action][/]',
            				'constraints' => array(
                                                
            				),
            				'defaults' => array(
            					'controller' => 'ApiWebService\Controller\AlboPretorioApi',
            					'action'     => 'index'
            				),
            			),
            		),
                        'utenti' => array(
            			'type'    => 'Segment',
            			'options' => array(
            				'route'    => '[/]utenti[/:action][/]',
            				'constraints' => array(
                                            
            				),
            				'defaults' => array(
            					'controller' => 'ApiWebService\Controller\UtentiApi',
            					'action'     => 'index'
            				),
            			),
            		),
            	),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
