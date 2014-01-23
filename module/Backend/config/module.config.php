<?php
return array(
    'controllers' => array(
        'invokables' => array(
			'Backend\Controller\Backend' => 'Backend\Controller\BackendController',
        ),
    ),
	'router' => array(
        'routes' => array(
        	/* HomePage */
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
                            'route'    => '/[:action][/]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array( ),
                        ),
                    ),
                ),
			),
        	/* Logged backend */
        	'homepage' => array(
        		'type'    => 'segment',
        		'options' => array(
        				'route'    => '/backend/main[/:lang[/:ctrl]][/]',
        				'constraints' => array(
        					'lang'     => '[a-z]{2}',
        					'ctrl'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        				),
        				'defaults' => array(
        					'controller' => 'Backend\Controller\Backend',
        					'action'     => 'index',
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
        ),
    ),
    'view_manager' => array(
    	'display_not_found_reason' => true,
		'display_exceptions'       => true,
		'doctype'                  => 'HTML5',
		'not_found_template'       => 'error/404',
		'exception_template'       => 'error/index',
    	'template_map' => array(
    		/* Render empty views to avoid error 500 */
    		'backend/backend/index' => __DIR__ . '/../../../view/index.phtml',
    	),
        'template_path_stack' => array(
        	__DIR__ . '/../../../view',
        	__DIR__ . '/../../../public'
        ),
    ),
);