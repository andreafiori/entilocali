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
                    // Change this to something specific to your module
                    'route'    => '/backend',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Backend\Controller',
                        'controller'    => 'Backend',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
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
    		// 'layout/custom' => __DIR__ . '/../view/backend/backend/backend.phtml',
    		'layout/custom' => __DIR__ . '/../../../public/backend/templates/default/backend.phtml',
    		'backend/backend/index' => __DIR__ . '/../../../public/backend/templates/default/login.phtml',
    	),
        'template_path_stack' => array(
            'Backend' => __DIR__ . '/../view',
        ),
    ),
	
	/* Custom layout for this module */
	'module_layouts' => array(
		'Backend' => 'layout/custom',
	),

);