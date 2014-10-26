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
                    'route'    => '/migrazione/tool/kronoweb[/]',
                    'constraints' => array(
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Migrazione\Controller\Migrazione',
                        'action'     => 'index'
                    ),
                    
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'cms' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                    'route'       => '[/]operation[/]',
                                    'constraints' => array(
                                        
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
