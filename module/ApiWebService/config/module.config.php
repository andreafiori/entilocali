<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ApiWebService\Controller\AlboPretorioApi'  => 'ApiWebService\Controller\AlboPretorioApiController',
            'ApiWebService\Controller\PostsApi'         => 'ApiWebService\Controller\PostsApiController',
            'ApiWebService\Controller\UtentiApi'        => 'ApiWebService\Controller\UtentiApiController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'main-api' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/api/v1/[/]',
                    'constraints' => array(
                    
                    ),
                    'defaults' => array(
                        'controller' => 'ApiWebService\Controller\PostsApi',
                    ),
                    
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'posts' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                    'route'    => '[/]posts[/][:id]',
                                    'constraints' => array(

                                    ),
                                    'defaults' => array(
                                        'controller' => 'ApiWebService\Controller\PostsApi',
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
