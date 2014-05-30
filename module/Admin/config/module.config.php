<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
            'Admin\Controller\Auth' => 'Admin\Controller\AuthController',
        ),
    ),
    'router' => array(
        'routes' => array(
            /* Login and logout */
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Auth',
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
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
            /* Backend when logged */
            'admin' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/admin/main[/:lang][/]',
                    'constraints' => array(
                        'lang' => '[a-z]{2}',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'formdata' => array(
                        'type'    => 'Segment',
                        'options' => array(
                                    'route'    => '[/]formdata[/][:formsetter][/][:id][/]',
                                    'constraints' => array(
                                                'formsetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'         => '[0-9]',
                                    ),
                                    'defaults' => array(
                                                'controller' => 'Admin\Controller\Admin',
                                                'action'     => 'index',
                                    ),
                        ),
                    ),
                    'datatable' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'       => '[/]datatable[/][:tablesetter][/]',
                                                'constraints' => array(
                                                    
                                                ),
                                                'defaults' => array(
                                                            'controller' => 'Admin\Controller\Admin',
                                                            'action'     => 'index',
                                                ),
                                    ),
                    ),
                    'formpost' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'         => '[/]formpost[/][:form_post_handler][/][:operation][/][:id][/]',
                                                'constraints'   => array(
                                                    'form_post_handler' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    'operation'         => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    'id'                => '[0-9]',
                                                ),
                                                'defaults' => array(
                                                    'controller' => 'Admin\Controller\Admin',
                                                    'action'     => 'formpost',
                                                ),
                                    ),
                    ),
                ),
            ),
            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_map' => array(
            'admin/admin/index'     => __DIR__ . '../../view/index.phtml',
            'admin/admin/formpost'  => __DIR__ . '../../view/admin/formpost-empty.phtml',
            'admin/'                => __DIR__ . '/../view/empty.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '../../view',
            __DIR__ . '../../public'
        ),
    ),
    // Backend Router Class Map
    'be_router' => array(
        "admin"                 => 'Admin\Model\AdminDashboard',
        "admin/formdata"        => 'Admin\Model\FormData\FormDataHandler',
        "admin/datatable"       => 'Admin\Model\DataTable\DataTableHandler',
    ),
    // FormData Class Map
    'formdata_classmap' => array(
        'assistenza'        => 'Admin\Model\Assistenza\AssistenzaFormDataHandler',
        'posts'             => 'Admin\Model\Posts\PostsFormDataHandler',
        'albo-pretorio'     => 'Admin\Model\AlboPretorio\AlboPretorioFormData',
        'stato-civile'      => 'Admin\Model\StatoCivile\StatoCivileFormData',
        'amministrazione-trasparente' => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormData',
    ),
    // Form POST class map
    'formdata_post' => array(
        'default' => 'Admin\Model\Posts\PostsPostHandler',
        'posts' => 'Admin\Model\Posts\PostsPostHandler'
    ),
    // DataTables Class Map
    'datatables_classmap' => array(
        'albo-pretorio'               => 'Admin\Model\AlboPretorio\AlboPretorioTable',
        'amministrazione-trasparente' => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteDataTable',
        'assistenza'                  => 'Admin\Model\Assistenza\AssistenzaDataTable',
        'categorie'                   => 'Admin\Model\Categorie\CategorieDataTable',
        'contatti'                    => 'Admin\Model\Contatti\ContattiTable',
        'faq'                         => 'Admin\Model\Faq\FaqTable',
        'newsletter'                  => 'Admin\Model\Newsletter\NewsletterTable',
        'posts'                       => 'Admin\Model\Posts\PostsDataTable',
        'stato-civile'                => 'Admin\Model\StatoCivile\StatoCivileDataTable',
    ),
);
