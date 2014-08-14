<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Feed\Controller\Feed' => 'Feed\Controller\FeedController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'feed' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/feed/rss',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Feed\Controller',
                        'controller'    => 'Feed',
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
                    'posts' => array(
                        'type'    => 'Segment',
                        'options' => array(
                                    'route'    => 'posts[/][:category][/]',
                                    'constraints' => array(
                                            'category' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ),
                                    'defaults' => array(
                                                'controller' => 'Admin\Controller\Admin',
                                                'action'     => 'index',
                                    ),
                        ),
                    ),
                    'albo-pretorio' => array(
                        'type'    => 'Segment',
                        'options' => array(
                                    'route'    => 'albo-pretorio[/][:category][/]',
                                    'constraints' => array(
                                            'category' => '[a-zA-Z][a-zA-Z0-9_-]*',
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
        'template_path_stack' => array(
            'Feed' => __DIR__ . '/../view',
        ),
        'strategies' => array(            
            'ViewJsonStrategy',
            'ViewFeedStrategy',
        ),
    ),
);
