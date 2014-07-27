<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
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
                        'controller'    => 'Admin',
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
                                    'route'    => 'formdata[/][:formsetter][/][:option][/][:id][/]',
                                    'constraints' => array(
                                                'formsetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'option'     => '[a-zA-Z0-9_-]*',
                                                'id'         => '[0-9]+',
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
                                                'route'       => 'datatable[/][:tablesetter][/:option][/]',
                                                'constraints' => array(
                                                        'tablesetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'option'      => '[a-zA-Z0-9_-]*',
                                                ),
                                                'defaults' => array(
                                                        'controller' => 'Admin\Controller\Admin',
                                                        'action'     => 'index',
                                                ),
                                    ),
                    ),
                    // lists using responsive tables
                    'tablelist' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'       => 'tablelist[/][:tablesetter][/:option][/]',
                                                'constraints' => array(
                                                        'tablesetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'option'      => '[a-zA-Z0-9_-]*',
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
                                                'route'         => 'formpost[/][:form_post_handler][/][:operation][/][:id][/]',
                                                'constraints'   => array(
                                                    'form_post_handler' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    'operation'         => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    'id'                => '[0-9]+',
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
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => include __DIR__  .'/../template_map.php',
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_map' => array(
            'admin/admin/login' => __DIR__ . '../../view/admin/auth/login.phtml',
            'admin/admin/index'     => __DIR__ . '../../view/admin/index.phtml',
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
        'albo-pretorio'                 => 'Admin\Model\AlboPretorio\AlboPretorioFormDataHandler',
        'amministrazione-trasparente'   => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormDataHandler',
        'stato-civile'                  => 'Admin\Model\StatoCivile\StatoCivileFormDataHandler',
        'contratti-pubblici-bandi'      => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciBandiFormDataHandler',
        'posts'                         => 'Admin\Model\Posts\PostsFormDataHandler',
        'categories'                    => 'Admin\Model\Categories\CategoriesFormDataHandler',
        'ticketing'                     => 'Admin\Model\Ticketing\TicketingFormDataHandler',
        'users'                         => 'Admin\Model\Users\UsersFormDataHandler',
    ),
    // FormData CRUD Class Map
    'formdata_crud_classmap' => array( 
        'albo-pretorio'               => 'Admin\Model\AlboPretorio\AlboPretorioCrudHandler',
        'amministrazione-trasparente' => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteCrudHandler',
        'ticketing'                   => 'Admin\Model\Ticketing\TicketingCrudHandler',
        'categories'                  => 'Admin\Model\Categories\CategoriesCrudHandler',
        'contatti'                    => 'Admin\Model\Contacts\ContactsCrudHandler',
        'faq'                         => 'Admin\Model\Faq\FaqCrudHandler',
        'newsletter'                  => 'Admin\Model\Newsletter\NewsletterCrudHandler',
        'posts'                       => 'Admin\Model\Posts\PostsCrudHandler',
        'stato-civile'                => 'Admin\Model\StatoCivile\StatoCivileCrudHandler',
        'users'                       => 'Admin\Model\Users\UsersCrudHandler',
    ),
    // DataTables Class Map
    'datatables_classmap' => array(
        'ticketing'                   => 'Admin\Model\Ticketing\TicketingDataTable',
        'categories'                  => 'Admin\Model\Categories\CategoriesDataTable',
        'contacts'                    => 'Admin\Model\Contacts\ContactsDataTable',
        'faq'                         => 'Admin\Model\Faq\FaqDataTable',
        'newsletter'                  => 'Admin\Model\Newsletter\NewsletterDataTable',
        'posts'                       => 'Admin\Model\Posts\PostsDataTable',
        'users'                       => 'Admin\Model\Users\UsersDataTable',
        'albo-pretorio'               => 'Admin\Model\AlboPretorio\AlboPretorioDataTable',
        'amministrazione-trasparente' => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteDataTable',
        'contratti-pubblici-bandi'    => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciBandiDataTable',
        'stato-civile'                => 'Admin\Model\StatoCivile\StatoCivileDataTable',
    ),
);