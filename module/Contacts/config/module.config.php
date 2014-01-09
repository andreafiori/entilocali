<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Contacts\Controller\Contacts' => 'Contacts\Controller\ContactsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'contacts' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/contacts',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Contacts\Controller',
                        'controller'    => 'Contacts',
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
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        	__DIR__ . '/../../../public'
        ),
    ),
);
