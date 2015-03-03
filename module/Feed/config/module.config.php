<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Feed\Controller\Feed' => 'Feed\Controller\FeedController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'feed-prefix' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/feed/rss[/]',
                    'constraints' => array(
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Feed\Controller\Feed',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'feed' => array(
                            'type'    => 'Segment',
                            'options' => array(
                                    'route'       => '[/][:resource[/]]',
                                    'constraints' => array(
                                            'resource' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Feed\Controller\Feed',
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
    /* Feed class map */
    'feed_class_map' => array(
        'contents'                      => 'Feed\Model\ContentsFeedResource',
        'blogs'                         => 'Feed\Model\ContentsFeedResource',
        'albo-pretorio'                 => 'Feed\Model\AlboPretorioFeedResource',
        'stato-civile'                  => 'Feed\Model\StatoCivileFeedResource',
        'amministrazione-trasparente'   => 'Feed\Model\AmministrazioneTrasparenteFeedResource',
    ),
);
