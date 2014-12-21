<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Migrazione\Controller\Migrazione' => 'Migrazione\Controller\MigrazioneController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'migrazione' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/migrations/tool/kronoweb[/]',
                    'constraints' => array(
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Migrazione\Controller\Migrazione',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'operation' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                    'route'       => '[/]operation[/][:subject][/]',
                                    'constraints' => array(
                                        'subject' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Migrazione\Controller\Migrazione',
                                        'action'     => 'operation',
                                    ),
                            ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Migrazione' => __DIR__ . '/../view',
        ),
    ),
);
