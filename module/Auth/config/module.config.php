<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Auth\Controller\Auth'              => 'Auth\Controller\AuthController',
            'Auth\Controller\RecoverPassword'   => 'Auth\Controller\RecoverPasswordController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Auth\Controller',
                        'controller'    => 'Auth',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'recover-password' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/auth/recover/password/:action[/:confirmcode][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z0-9_-]*',
                        'confirmcode' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Auth\Controller\RecoverPassword',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Auth' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'auth/recover-password/sendrecoverrequest' => __DIR__ . '/../view/auth/auth/empty.phtml',
        ),
    ),
);
