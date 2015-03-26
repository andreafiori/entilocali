<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Auth'                 => 'Admin\Controller\AuthController',
            'Admin\Controller\Admin'                => 'Admin\Controller\AdminController',
            'Admin\Controller\FormDataPost'         => 'Admin\Controller\FormDataPostController',
            'Admin\Controller\HomePagePutter'       => 'Admin\Controller\HomePagePutter',
            'Admin\Controller\Pdf\AlboPretorioPdf'  => 'Admin\Controller\Pdf\AlboPretorioPdfController',
            'Admin\Controller\SezioniPositionsUpdateController' => 'Admin\Controller\SezioniPositionsUpdateController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Auth',
                        'action'        => 'showFormLogin',
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
                            'constraints' => array(

                            ),
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
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\SezioniPositionsUpdateController',
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
                    'pdf-albo-pretorio' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'         => 'pdf/albo-pretorio/:id',
                                                'constraints'   => array(
                                                    'id' => '[0-9]+',
                                                ),
                                                'defaults' => array(
                                                    'controller' => 'Admin\Controller\Pdf\AlboPretorioPdf',
                                                    'action'     => 'relata',
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
            'admin/admin/login'                     => __DIR__ . '../../view/admin/auth/login.phtml',
            'admin/admin/index'                     => __DIR__ . '../../view/admin/index.phtml',
            'admin/admin/formpost'                  => __DIR__ . '../../view/admin/formpost-empty.phtml',
            'admin/albo-pretorio-pdf/relata'        => __DIR__ . '../../view/admin/albo-pretorio-pdf/relata.phtml',
            'admin/form-data-post/index'            => __DIR__ . '../../view/admin/formpost-empty.phtml',
            'admin/admin/invio-ente-terzo'          => __DIR__ . '/../view/invio-ente-terzo-empty.phtml',
            'admin/admin/config-edit'               => __DIR__ . '/../view/config-edit-empty.phtml',
            'admin/admin/delete-element'            => __DIR__ . '/../view/delete-element.phtml',
            'admin/admin/migrazione'                => __DIR__ . '/../view/migrazione.phtml',
            'admin/sezioni-positions-update/index'  => __DIR__ . '/../view/empty.phtml',
            'admin/'                                => __DIR__ . '/../view/empty.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '../../view',
            __DIR__ . '../../public'
        ),
    ),
    /* Backend Router Class Map */
    'be_router' => array(
        "admin"                                  => '\Admin\Model\AdminDashboard',
        "admin/formdata"                         => '\Admin\Model\FormData\FormDataHandler',
        "admin/delete-element"                   => '\Admin\Model\Delete\DeleteElementHandler',
        "admin/datatable"                        => '\Admin\Model\DataTable\DataTableHandler',
        "admin/invio-ente-terzo"                 => '\Admin\Model\EntiTerzi\InvioEnteTerzoHandler',
        "admin/posizioni-sezioni"                => '\Admin\Model\Sezioni\SezioniPositionsHandler',
        "admin/posizioni-sezioni-update"         => '\Admin\Model\Sezioni\SezioniPositionsPostHandler',
        "admin/migrazione"                       => '\Admin\Model\Migrazione\MigrazioneHandler',
        "admin/contratti-pubblici-aggiudicatari" => '\Admin\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariHandler',
        "admin/users-roles-permissions"          => '\Admin\Model\Users\Roles\UsersRolesPermissionsHandler',
    ),
    /* FormData Class Map */
    'formdata_classmap' => array(
        'attachments'                   => 'Admin\Model\Attachments\AttachmentsFormDataHandler',
        'albo-pretorio'                 => 'Admin\Model\AlboPretorio\AlboPretorioArticoliFormDataHandler',
        'albo-pretorio-sezioni'         => 'Admin\Model\AlboPretorio\AlboPretorioSezioniFormDataHandler',
        'amministrazione-trasparente'   => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormDataHandler',
        'atti-concessione'              => 'Admin\Model\AttiConcessione\AttiConcessioneFormDataHandler',
        'atti-concessione-settori'      => 'Admin\Model\AttiConcessione\AttiConcessioneSettoriFormDataHandler',
        'atti-concessione-resp'         => 'Admin\Model\AttiConcessione\AttiConcessioneRespProcFormDataHandler',
        'contenuti'                     => 'Admin\Model\Contenuti\ContenutiFormDataHandler',
        'configurations'                => 'Admin\Model\Config\ConfigFormDataHandler',
        'sezioni-contenuti'             => 'Admin\Model\Sezioni\SezioniFormDataHandler',
        'sottosezioni-contenuti'        => 'Admin\Model\Sezioni\SottoSezioniFormDataHandler',
        'sottosezioni-amm-trasparente'  => 'Admin\Model\Sezioni\SottoSezioniFormDataHandler',
        'stato-civile'                  => 'Admin\Model\StatoCivile\StatoCivileFormDataHandler',
        'stato-civile-sezioni'          => 'Admin\Model\StatoCivile\StatoCivileSezioniFormDataHandler',
        'contratti-pubblici'            => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciFormDataHandler',
        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteFormDataHandler',
        'contratti-pubblici-responsabili'       => 'Admin\Model\ContrattiPubblici\ResponsabiliProcedimento\ResponsabiliProcedimentoFormDataHandler',
        'contratti-pubblici-settori'            => 'Admin\Model\ContrattiPubblici\Settori\SettoriFormDataHandler',
        'contratti-pubblici-operatori'          => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriFormDataHandler',
        'enti-terzi'                    => 'Admin\Model\EntiTerzi\EntiTerziFormDataHandler',
        'tickets'                       => 'Admin\Model\Tickets\TicketsFormDataHandler',
        'users'                         => 'Admin\Model\Users\UsersFormDataHandler',
        'categories'                    => 'Admin\Model\Posts\CategoriesFormDataHandler',
        'contents'                      => 'Admin\Model\Posts\PostsFormDataHandler',
        'photo'                         => 'Admin\Model\Posts\PostsFormDataHandler',
        'blogs'                         => 'Admin\Model\Posts\PostsFormDataHandler',
    ),
    /* FormData CRUD Class Map */
    'formdata_crud_classmap' => array( 
        'albo-pretorio'               => 'Admin\Model\AlboPretorio\AlboPretorioArticoliCrudHandler',
        'albo-pretorio-sezioni'       => 'Admin\Model\AlboPretorio\AlboPretorioSezioniCrudHandler',
        'amministrazione-trasparente' => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteCrudHandler',
        'attachments'                 => 'Admin\Model\Attachments\AttachmentsCrudHandler',
        'atti-concessione'            => 'Admin\Model\AttiConcessione\AttiConcessioneCrudHandler',
        'atti-concessione-settori'    => 'Admin\Model\AttiConcessione\AttiConcessioneSettoriCrudHandler',
        'atti-concessione-resp'       => 'Admin\Model\AttiConcessione\AttiConcessioneRespProcCrudHandler',
        'categories'                  => 'Admin\Model\Posts\CategoriesCrudHandler',
        'contenuti'                   => 'Admin\Model\Contenuti\ContenutiCrudHandler',
        'configurations'              => 'Admin\Model\Config\ConfigCrudHandler',
        'sezioni-contenuti'           => 'Admin\Model\Sezioni\SezioniCrudHandler',
        'sottosezioni-contenuti'      => 'Admin\Model\Sezioni\SottoSezioniCrudHandler',
        'contratti-pubblici'                    => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciCrudHandler',
        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteCrudHandler',
        'contratti-pubblici-responsabili'       => 'Admin\Model\ContrattiPubblici\ResponsabiliProcedimento\ResponsabiliProcedimentoCrudHandler',
        'contratti-pubblici-settori'            => 'Admin\Model\ContrattiPubblici\Settori\SettoriCrudHandler',
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
    ),
    /* DataTables Class Map */
    'datatables_classmap' => array(
        'tickets'                               => 'Admin\Model\Tickets\TicketsDataTable',
        'categories'                            => 'Admin\Model\Posts\CategoriesDataTable',
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
        'albo-pretorio'                         => 'Admin\Model\AlboPretorio\AlboPretorioArticoliDataTable',
        'atti-ufficiali'                        => 'Admin\Model\AlboPretorio\AttiUfficialiDataTable',
        'albo-pretorio-sezioni'                 => 'Admin\Model\AlboPretorio\AlboPretorioSezioniDataTable',
        'amministrazione-trasparente'           => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteDataTable',
        'atti-concessione'                      => 'Admin\Model\AttiConcessione\AttiConcessioneDataTable',
        'atti-concessione-settori'              => 'Admin\Model\AttiConcessione\AttiConcessioneSettoriDataTable',
        'atti-concessione-resp'                 => 'Admin\Model\AttiConcessione\AttiConcessioneRespProcDataTable',
        'contratti-pubblici'                    => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciDataTable',
        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteDataTable',
        'contratti-pubblici-responsabili'       => 'Admin\Model\ContrattiPubblici\ResponsabiliProcedimento\ResponsabiliProcedimentoDataTable',
        'contratti-pubblici-settori'            => 'Admin\Model\ContrattiPubblici\Settori\SettoriDataTable',
        'contratti-pubblici-operatori'          => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriDataTable',
        'enti-terzi'                            => 'Admin\Model\EntiTerzi\EntiTerziDataTable',
        'logs'                                  => 'Admin\Model\Logs\LogsDataTable',
        'stato-civile'                          => 'Admin\Model\StatoCivile\StatoCivileDataTable',
        'stato-civile-sezioni'                  => 'Admin\Model\StatoCivile\StatoCivileSezioniDataTable',
        'users'                                 => 'Admin\Model\Users\UsersDataTable',
        'users-roles'                           => 'Admin\Model\Users\Roles\UsersRolesDataTable',
    ),
);
