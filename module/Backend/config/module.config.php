<?php
return array(
    'controllers' => array(
        'invokables' => array(
			'Backend\Controller\Backend'   => 'Backend\Controller\BackendController',
			'Backend\Controller\Formdata'  => 'Backend\Controller\FormdataController',
			'Backend\Controller\Datatable' => 'Backend\Controller\DatatableController',
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
        	'homepage' => array(
        		'type'    => 'segment',
        		'options' => array(
        				'route'    => '/backend/main[/:lang][/]',
        				'constraints' => array(
        					'lang'     => '[a-z]{2}',
        				),
        				'defaults' => array(
        					'controller' => 'Backend\Controller\Backend',
        					'action'     => 'index',
        				),
        		),
        		'may_terminate' => true,
				'child_routes' => array(
						'default' => array(
								'type'    => 'Segment',
								'options' => array(
										'route'    => '[/]formdata[/][:formsetter][/][:id][/]',
										'constraints' => array(
												'formsetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id' 		 => '[0-9]',
										),
										'defaults' => array(
												'controller' => 'Backend\Controller\Formdata',
												'action'     => 'index',
										),
								),
						),
						'formpost' => array(
								'type'    => 'Segment',
								'options' => array(
										'route'    => '[/]formpost[/][:controller[/:action]][/]',
										'constraints' => array(
												'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    							'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
										),
										'defaults' => array(
												/* controller and action are get automatically */
										),
								),
						),
						'datatable' => array(
								'type'    => 'Segment',
								'options' => array(
										'route'   	  => '[/]datatable[/]',
										'constraints' => array(
												
										),
										'defaults' => array(
												'controller' => 'Backend\Controller\Datatable',
												'action'     => 'index',
										),
								),
						),
				),
        	),
        ),
    ),
	'controller_plugins' => array(
			'invokables' => array(
					'BackendSetupInitializerPlugin' => 'Application\Controller\Plugin\BackendSetupInitializerPlugin',
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
    		'backend/backend/index' => __DIR__ . '../../view/index.phtml',
    		'backend/backend/formpost' => __DIR__ . '../../view/index.phtml',
    		'backend/backend/formdata' => __DIR__ . '../../view/index.phtml',
    		'backend/backend/datatable' => __DIR__ . '../../view/index.phtml',
    		'backend/backend/recoverpassword' => __DIR__ . '../../view/index.phtml',
    		/* Landing page on error 404 */
    		'error/dbconnection' => __DIR__ . '../../view/error/dbconnection.phtml',
    		'backend/empty' => __DIR__ . '../../view/empty.phtml',
    	),
        'template_path_stack' => array(
        	__DIR__ . '../../view',
        	__DIR__ . '../../public'
        ),
    ),
);