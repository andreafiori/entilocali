<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ApiWebService\Controller\DefaultApi' => 'ApiWebService\Controller\DefaultApiController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'main-api' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/api/v1[/]',
                    'constraints' => array(
                        
                    ),
                    'defaults' => array(
                        'controller' => 'ApiWebService\Controller\DefaultApi',
                    ),
                    
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'cms' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                    'route'       => 'cms[/][:resource][/][:id][/]',
                                    'constraints' => array(
                                            'resource' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            'id'       => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'ApiWebService\Controller\DefaultApi',
                                        'action'     => 'index',
                                    ),
                            ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
