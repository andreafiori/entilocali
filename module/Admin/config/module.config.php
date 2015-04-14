<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\ForgotPasswordController'                         => 'Admin\Controller\ForgotPasswordController',
            'Admin\Controller\Admin'                                            => 'Admin\Controller\AdminController',
            'Admin\Controller\FormDataPost'                                     => 'Admin\Controller\FormDataPostController',

            /* Albo Pretorio */
            'Admin\Controller\AlboPretorio\AlboPretorioSummaryController'       => 'Admin\Controller\AlboPretorio\AlboPretorioSummaryController',
            'Admin\Controller\AlboPretorio\AlboPretorioFormController'          => 'Admin\Controller\AlboPretorio\AlboPretorioFormController',
            'Admin\Controller\AlboPretorio\AlboPretorioOperationsController'    => 'Admin\Controller\AlboPretorio\AlboPretorioOperationsController',
            'Admin\Controller\AlboPretorio\AlboPretorioRelataPdfController'     => 'Admin\Controller\AlboPretorio\AlboPretorioRelataPdfController',

            /* Enti Terzi */
            'Admin\Controller\EntiTerzi\EntiTerziFormController'                => 'Admin\Controller\EntiTerzi\EntiTerziFormController',
            'Admin\Controller\EntiTerzi\EntiTerziSummaryController'             => 'Admin\Controller\EntiTerzi\EntiTerziSummaryController',

            /* Blogs */
            'Admin\Controller\Posts\BlogsCategoriesSummaryController'           => 'Admin\Controller\Posts\BlogsCategoriesSummaryController',
            'Admin\Controller\Posts\BlogsSummaryController'                     => 'Admin\Controller\Posts\BlogsSummaryController',
            'Admin\Controller\Posts\BlogsFormController'                        => 'Admin\Controller\Posts\BlogsFormController',

            /* Photo */


            'Admin\Controller\SezioniPositionsUpdateController'                 => 'Admin\Controller\SezioniPositionsUpdateController',
            'Admin\Controller\SottoSezioniPositionsUpdateController'            => 'Admin\Controller\SottoSezioniPositionsUpdateController',
            'Admin\Controller\Users\RespProc\UsersRespProcController'           => 'Admin\Controller\Users\RespProc\UsersRespProcController',
        ),
    ),
    'router' => array(
        'routes' => array(
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
                    'homepage-putter' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => 'homepage/putter/[:modulecode][/][:id[/]]',
                            'constraints' => array(
                                'modulecode' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\HomePageController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'formdata' => array(
                        'type'    => 'Segment',
                        'options' => array(
                                    'route'    => 'formdata[/][:formsetter][/][:option[/]][:id[/]]',
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
                    'albo-pretorio-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'albo-pretorio/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioSummaryController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'albo-pretorio/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioFormController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-operations' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'albo-pretorio/operations/[:action[/]][:id[/]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioOperationsController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'enti-terzi-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'enti-terzi/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'page'        => '[0-9]+',
                                'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'       => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\EntiTerzi\EntiTerziSummaryController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'enti-terzi-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'enti-terzi/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\EntiTerzi\EntiTerziFormController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'posts-categories-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'posts/categories/summary/:moduleCode[/][:categoryId[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'moduleCode'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'categoryId'  => '[0-9]+',
                                'page'        => '[0-9]+',
                                'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'       => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Posts\BlogsCategoriesSummaryController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'blogs-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'blogs/summary[/][:categoryId[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'categoryId'  => '[0-9]+',
                                'page'        => '[0-9]+',
                                'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'       => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Posts\BlogsSummaryController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'posts-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'posts/form/:formtype[/][:id[/]]',
                            'constraints' => array(
                                'formtype'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'        => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Posts\BlogsFormController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'datatable' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'       => 'datatable[/][:tablesetter[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                                                'constraints' => array(
                                                        'tablesetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'page'        => '[0-9]+',
                                                        'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'order'       => 'ASC|DESC',
                                                ),
                                                'defaults' => array(
                                                        'controller' => 'Admin\Controller\Admin',
                                                        'action'     => 'index',
                                                ),
                                    ),
                    ),
                    /* Datatables spike with server side pagination */
                    'datatables' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'datatables/client-side[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'datatables-server-side' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'datatables/server-side[/]',
                            'constraints' => array(
                                'tablesetter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    /* Delete an element from db endpoint */
                    'delete-element' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'delete-element/[:type]/[:id[/]]',
                            'constraints' => array(
                                'type' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'   => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'migrazione' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'migrazione/tool[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'invio-ente-terzo' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'       => 'invio-ente-terzo[/][:modulename][/][:id][/]',
                                                'constraints' => array(
                                                        'modulename' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'id'         => '[0-9]+',
                                                ),
                                                'defaults' => array(
                                                        'controller' => 'Admin\Controller\Admin',
                                                        'action'     => 'index',
                                                ),
                                    ),
                    ),
                    'posizioni-sezioni' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'posizioni/sezioni[/]',
                            'constraints' => array(),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'posizioni-sezioni-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'posizioni/sezioni/update[/]',
                            'constraints' => array(),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\SezioniPositionsUpdateController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'posizioni-sottosezioni' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'posizioni/sottosezioni/[:sezioneId[/]][:profonditaDa[/]]',
                            'constraints' => array(
                                'sezioneId'     => '[0-9]+',
                                'profonditaDa'  => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'posizioni-sottosezioni-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'posizioni/sottosezioni/update[/]',
                            'constraints' => array(),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\SottoSezioniPositionsUpdateController',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-aggiudicatari' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'contratti-pubblici-aggiudicatari/elenco[[/]:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-roles-permissions' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'users/roles/permissions/[:roleId[/]]',
                            'constraints' => array(
                                'roleId' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-resp-proc-management' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'users/resp-proc/management[/]',
                            'constraints' => array(),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Admin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'formpost' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'         => 'formpost[/][:form_post_handler][/][:operation][/][:id[/]]',
                                                'constraints'   => array(
                                                    'form_post_handler' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    'operation'         => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    'id'                => '[0-9]+',
                                                ),
                                                'defaults' => array(
                                                    'controller' => 'Admin\Controller\FormDataPost',
                                                    'action'     => 'index',
                                                ),
                                    ),
                    ),
                    'albo-pretorio-relata-pdf' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'         => 'albo-pretorio/relata/pdf/:id',
                                                'constraints'   => array(
                                                    'id' => '[0-9]+',
                                                ),
                                                'defaults' => array(
                                                    'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioRelataPdfController',
                                                    'action'     => 'index',
                                                ),
                                    ),
                    ),
                    'users-resp-proc' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'         => 'users/responsabili-procedimento[/]',
                            'constraints'   => array(),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\RespProc\UsersRespProcController',
                                'action'     => 'index',
                            ),
                        ),
                        'child_routes' => array(
                            'insert' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => 'homepage/putter/[:modulecode][/][:id[/]]',
                                    'constraints' => array(
                                        'modulecode' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id'         => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Admin\Controller\HomePageController',
                                        'action'     => 'index',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'translator' => array(
        'locale' => 'it_IT',
        'translation_file_patterns' => array(
            array(
                'type'      => 'gettext',
                'base_dir'  => __DIR__ . '/../language',
                'pattern'   => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_map' => array(
            'admin/admin/login'                             => __DIR__ . '../../view/admin/auth/login.phtml',
            'admin/admin/index'                             => __DIR__ . '../../view/admin/index.phtml',
            'admin/admin/formpost'                          => __DIR__ . '../../view/admin/formpost-empty.phtml',

            /* Albo pretorio */
            'admin/albo-pretorio-summary/index'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-form/index'                => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-pdf/relata'                => __DIR__ . '../../view/admin/albo-pretorio-pdf/relata.phtml',

            /* Posts */
            'admin/blogs-summary/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-form/index'                        => __DIR__ . '/../view/admin/empty.phtml',

            'admin/form-data-post/index'                    => __DIR__ . '../../view/admin/formpost-empty.phtml',

            'admin/admin/invio-ente-terzo'                  => __DIR__ . '/../view/invio-ente-terzo-empty.phtml',
            "admin/enti-terzi-summary/index"                => __DIR__ . '/../view/admin/empty.phtml',

            'admin/admin/config-edit'                       => __DIR__ . '/../view/config-edit-empty.phtml',
            'admin/admin/delete-element'                    => __DIR__ . '/../view/delete-element.phtml',
            'admin/admin/migrazione'                        => __DIR__ . '/../view/migrazione.phtml',
            'admin/sezioni-positions-update/index'          => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-positions-update/index'    => __DIR__ . '/../view/admin/empty.phtml',
            'admin/'                                        => __DIR__ . '/../view/admin/empty.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view/',
            __DIR__ . '../../public',
        ),
    ),
    /* Backend Router Class Map */
    'be_router' => array(
        "admin"                                  => '\Admin\Model\AdminDashboard',
        "admin/formdata"                         => '\Admin\Model\FormData\FormDataHandler',
        "admin/delete-element"                   => '\Admin\Model\Delete\DeleteElementHandler',
        "admin/datatable"                        => '\Admin\Model\DataTable\DataTableHandler',
        "admin/datatables"                       => '\Admin\Model\DataTable\DataTablesHandler',
        "admin/datatables-server-side"           => '\Admin\Model\DataTable\DataTablesServerSideHandler',
        "admin/invio-ente-terzo"                 => '\Admin\Model\EntiTerzi\InvioEnteTerzoHandler',
        "admin/posizioni-sezioni"                => '\Admin\Model\Sezioni\SezioniPositionsHandler',
        "admin/posizioni-sottosezioni"           => '\Admin\Model\Sezioni\SottoSezioniPositionsHandler',
        "admin/migrazione"                       => '\Admin\Model\Migrazione\MigrazioneHandler',
        "admin/contratti-pubblici-aggiudicatari" => '\Admin\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariHandler',
        "admin/users-roles-permissions"          => '\Admin\Model\Users\Roles\UsersRolesPermissionsHandler',
        "admin/users-resp-proc-management"       => '\Admin\Model\Users\RespProc\UsersRespProcHandler',
    ),
    /* FormData Class Map */
    'formdata_classmap' => array(
        'attachments'                           => 'Admin\Model\Attachments\AttachmentsFormDataHandler',
        'albo-pretorio-sezioni'                 => 'Admin\Model\AlboPretorio\AlboPretorioSezioniFormDataHandler',
        'amministrazione-trasparente'           => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormDataHandler',
        'atti-concessione'                      => 'Admin\Model\AttiConcessione\AttiConcessioneFormDataHandler',
        'contenuti'                             => 'Admin\Model\Contenuti\ContenutiFormDataHandler',
        'configurations'                        => 'Admin\Model\Config\ConfigFormDataHandler',
        'sezioni-contenuti'                     => 'Admin\Model\Sezioni\SezioniFormDataHandler',
        'sottosezioni-contenuti'                => 'Admin\Model\Sezioni\SottoSezioniFormDataHandler',
        'sottosezioni-amm-trasparente'          => 'Admin\Model\Sezioni\SottoSezioniFormDataHandler',
        'stato-civile'                          => 'Admin\Model\StatoCivile\StatoCivileFormDataHandler',
        'stato-civile-sezioni'                  => 'Admin\Model\StatoCivile\StatoCivileSezioniFormDataHandler',
        'contratti-pubblici'                    => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciFormDataHandler',
        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteFormDataHandler',
        'contratti-pubblici-operatori'          => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriFormDataHandler',
        'tickets'                               => 'Admin\Model\Tickets\TicketsFormDataHandler',
        'users'                                 => 'Admin\Model\Users\UsersFormDataHandler',
        'users-settori'                         => 'Admin\Model\Users\Settori\UsersSettoriFormDataHandler',
        'categories'                            => 'Admin\Model\Posts\CategoriesFormDataHandler',
        'contents'                              => 'Admin\Model\Posts\PostsFormDataHandler',
    ),
    /* FormData CRUD Class Map */
    'formdata_crud_classmap' => array( 
        'albo-pretorio'                         => 'Admin\Model\AlboPretorio\AlboPretorioArticoliCrudHandler',
        'albo-pretorio-sezioni'                 => 'Admin\Model\AlboPretorio\AlboPretorioSezioniCrudHandler',
        'amministrazione-trasparente'           => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteCrudHandler',
        'attachments'                           => 'Admin\Model\Attachments\AttachmentsCrudHandler',
        'atti-concessione'                      => 'Admin\Model\AttiConcessione\AttiConcessioneCrudHandler',
        'blogs'                                 => 'Admin\Model\Posts\PostsCrudHandler',
        'categories'                            => 'Admin\Model\Posts\CategoriesCrudHandler',
        'contenuti'                             => 'Admin\Model\Contenuti\ContenutiCrudHandler',
        'configurations'                        => 'Admin\Model\Config\ConfigCrudHandler',
        'sezioni-contenuti'                     => 'Admin\Model\Sezioni\SezioniCrudHandler',
        'sottosezioni-contenuti'                => 'Admin\Model\Sezioni\SottoSezioniCrudHandler',
        'contratti-pubblici'                    => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciCrudHandler',
        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteCrudHandler',
        'contratti-pubblici-operatori'          => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriCrudHandler',
        'contatti'                              => 'Admin\Model\Contacts\ContactsCrudHandler',
        'faq'                                   => 'Admin\Model\Faq\FaqCrudHandler',
        'newsletter'                            => 'Admin\Model\Newsletter\NewsletterCrudHandler',
        'posts'                                 => 'Admin\Model\Posts\PostsCrudHandler',
        'enti-terzi'                            => 'Admin\Model\EntiTerzi\EntiTerziCrudHandler',
        'invio-ente-terzo'                      => 'Admin\Model\EntiTerzi\InvioEnteTerzoCrudHandler',
        'stato-civile'                          => 'Admin\Model\StatoCivile\StatoCivileCrudHandler',
        'stato-civile-sezioni'                  => 'Admin\Model\StatoCivile\StatoCivileSezioniCrudHandler',
        'tickets'                               => 'Admin\Model\Tickets\TicketsCrudHandler',
        'users'                                 => 'Admin\Model\Users\UsersCrudHandler',
        'users-roles'                           => 'Admin\Model\Users\Roles\UsersRolesCrudHandler',
        'users-settori'                         => 'Admin\Model\Users\Settori\UsersSettoriCrudHandler',
        'users-todo'                            => 'Admin\Model\Users\Roles\UsersTodoCrudHandler',
    ),
    /* DataTables Class Map */
    'datatables_classmap' => array(
        'tickets'                               => 'Admin\Model\Tickets\TicketsDataTable',
        'contacts'                              => 'Admin\Model\Contacts\ContactsDataTable',
        'faq'                                   => 'Admin\Model\Faq\FaqDataTable',
        'newsletter'                            => 'Admin\Model\Newsletter\NewsletterDataTable',
        'contenuti'                             => 'Admin\Model\Contenuti\ContenutiDataTable',
        'sezioni-contenuti'                     => 'Admin\Model\Sezioni\SezioniDataTable',
        'sottosezioni-contenuti'                => 'Admin\Model\Sezioni\SottosezioniContenutiDataTable',
        'sottosezioni-amm-trasparente'          => 'Admin\Model\Sezioni\SottosezioniAmmTrasparenteDataTable',
        'contents'                              => 'Admin\Model\Posts\PostsDataTable',
        'photo'                                 => 'Admin\Model\Posts\PostsDataTable',
        'blog'                                  => 'Admin\Model\Posts\PostsDataTable',
        'atti-ufficiali'                        => 'Admin\Model\AlboPretorio\AttiUfficialiDataTable',
        'albo-pretorio-sezioni'                 => 'Admin\Model\AlboPretorio\AlboPretorioSezioniDataTable',
        'amministrazione-trasparente'           => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteDataTable',
        'atti-concessione'                      => 'Admin\Model\AttiConcessione\AttiConcessioneDataTable',
        'atti-concessione-mod-assign'           => 'Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneDataTable',
        'contratti-pubblici'                    => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciDataTable',
        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteDataTable',
        'contratti-pubblici-operatori'          => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriDataTable',
        'logs'                                  => 'Admin\Model\Logs\LogsDataTable',
        'stato-civile'                          => 'Admin\Model\StatoCivile\StatoCivileDataTable',
        'stato-civile-sezioni'                  => 'Admin\Model\StatoCivile\StatoCivileSezioniDataTable',
        'users'                                 => 'Admin\Model\Users\UsersDataTable',
        'users-roles'                           => 'Admin\Model\Users\Roles\UsersRolesDataTable',
        'users-settori'                         => 'Admin\Model\Users\Settori\UsersSettoriDataTable',
        'users-resp-procedimento'               => 'Admin\Model\Users\Roles\UsersRespProcDataTable',
    ),
);
