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
        ),
    ),
	
    'view_manager' => array(
    	'display_not_found_reason' => true,
    	'display_exceptions'       => true,
    	'template_map' => array(
    		'layout/layout'        => __DIR__ . '/../view/layout/layout.phtml',
    		'error/404'            => __DIR__ . '/../view/error/404.phtml',
    		'error/index'          => __DIR__ . '/../view/error/index.phtml',
    	),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        	__DIR__ . '/../../../public'
        ),
    ),
	
);