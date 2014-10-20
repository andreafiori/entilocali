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
                                    'route'       => 'cms[/][:output_format][/][:resource][/][:id][/]',
                                    'constraints' => array(
                                            'output_format' => 'xml|json',
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
    /* API Resources class map */
    'resources_class_map' => array(
        'contents'                      => 'ApiWebService\Model\Resources\PostsApiResource',
        'blogs'                         => 'ApiWebService\Model\Resources\PostsApiResource',
        'albo-pretorio'                 => 'ApiWebService\Model\Resources\AlboPretorioApiResource',
        'atti-ufficiali'                => 'ApiWebService\Model\Resources\AlboPretorioApiResource',
        'stato-civile'                  => 'ApiWebService\Model\Resources\PostsApiResource',
        'amministrazione-trasparente'   => 'ApiWebService\Model\Resources\AmministrazioneTrasparenteApiResource',
    ),
);
