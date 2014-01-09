<?php
return array(
    'controllers' => array(
        'invokables' => array(
			'Backend\Controller\Backend' => 'Backend\Controller\BackendController',
        ),
    ),
	'router' => array(
        'routes' => array(
            'backend' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/backend',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Backend\Controller',
                        'controller'    => 'Backend',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array( ),
                        ),
                    ),
                ),
			),
        	'formdata' => array(
        		'type'    => 'segment',
        		'options' => array(
        				'route'    => '/backend/formdata[/][:ctrl]',
        				'constraints' => array(
        						'ctrl'	   => '[a-zA-Z][a-zA-Z0-9_-]*',
        				),
        				'defaults' => array(
        					'controller' => 'Backend\Controller\Backend',
        					'action'     => 'formdata',
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
        	'grid' => array(
        			'type'    => 'segment',
        			'options' => array(
        					'route'    => '/backend/grid[/][:ctrl]',
        					'constraints' => array(
        							'ctrl'	   => '[a-zA-Z][a-zA-Z0-9_-]*',
        					),
        					'defaults' => array(
        							'controller' => 'Backend\Controller\Backend',
        							'action'     => 'grid',
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
    'view_manager' => array(
    	'display_not_found_reason' => true,
    	'display_exceptions'       => true,
    	'template_map' => array(
    		'backend/backend/login' => __DIR__ . '/../../../view/login.phtml',
    		'backend/backend/index' => __DIR__ . '/../../../view/index.phtml',
    	),
        'template_path_stack' => array(
        	__DIR__ . '/../../../view',
        	__DIR__ . '/../../../public'
        ),
    ),
);