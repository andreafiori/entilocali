<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
            'Admin\Controller\Auth' => 'Admin\Controller\AuthController',
        ),
    ),
    'router' => array(
        'routes' => array(
            /* Login and logout */
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Auth',
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
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
            /* Backend when logged */
            'admin' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/admin/main[/:lang][/]',
                    'constraints' => array(
                        'lang' => '[a-z]{2}',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'formdata' => array(
                        'type'    => 'Segment',
                        'options' => array(
                                    'route'    => '[/]formdata[/][:formsetter][/][:id][/]',
                                    'constraints' => array(
                                                'formsetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'         => '[0-9]',
                                    ),
                                    'defaults' => array(
                                                'controller' => 'Admin\Controller\Admin',
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
                                                                'controller' => 'Admin\Controller\Admin',
                                                                'action'     => 'index',
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
            'admin/admin/index' => __DIR__ . '../../view/index.phtml',
            'admin/' => __DIR__ . '/../view/empty.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '../../view',
            __DIR__ . '../../public'
        ),
    ),
);
