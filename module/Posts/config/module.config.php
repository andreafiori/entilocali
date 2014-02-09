<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Posts\Controller\Posts' => 'Posts\Controller\PostsController',
            'Posts\Controller\Photo' => 'Posts\Controller\PhotoController',
        	'PostsFormPosts' 		 => 'Posts\Controller\PostsFormPostsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'posts' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/posts',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Posts\Controller',
                        'controller'    => 'Posts',
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
            'Posts' => __DIR__ . '/../view',
        ),
    ),
);