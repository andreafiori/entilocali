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
