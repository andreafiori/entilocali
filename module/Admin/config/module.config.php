<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin'                                            => 'Admin\Controller\AdminController',

            /* Attachment files */
            'Admin\Controller\Attachments\AttachmentsForm'                      => 'Admin\Controller\Attachments\AttachmentsFormController',
            'Admin\Controller\Attachments\AttachmentsFormUpdate'                => 'Admin\Controller\Attachments\AttachmentsFormUpdateController',

            /* Insert and update Ajax POSTs */
            'Admin\Controller\FormDataPost'                                     => 'Admin\Controller\FormDataPostController',

            /* Contenuti */
            'Admin\Controller\Contenuti\ContenutiSummary'                       => 'Admin\Controller\Contenuti\ContenutiSummaryController',
            'Admin\Controller\Contenuti\ContenutiForm'                          => 'Admin\Controller\Contenuti\ContenutiFormController',

            /* Albo Pretorio */
            'Admin\Controller\AlboPretorio\AlboPretorioSummary'                 => 'Admin\Controller\AlboPretorio\AlboPretorioSummaryController',
            'Admin\Controller\AlboPretorio\AlboPretorioForm'                    => 'Admin\Controller\AlboPretorio\AlboPretorioFormController',
            'Admin\Controller\AlboPretorio\AlboPretorioOperations'              => 'Admin\Controller\AlboPretorio\AlboPretorioOperationsController',
            'Admin\Controller\AlboPretorio\AlboPretorioRelataPdf'               => 'Admin\Controller\AlboPretorio\AlboPretorioRelataPdfController',
            'Admin\Controller\AlboPretorio\AlboPretorioSezioniForm'             => 'Admin\Controller\AlboPretorio\AlboPretorioSezioniFormController',
            'Admin\Controller\AlboPretorio\AlboPretorioSezioniSummary'          => 'Admin\Controller\AlboPretorio\AlboPretorioSezioniSummaryController',

            /* Stato Civile */
            'Admin\Controller\StatoCivile\StatoCivileSummary'                   => 'Admin\Controller\StatoCivile\StatoCivileSummaryController',
            'Admin\Controller\StatoCivile\StatoCivileForm'                      => 'Admin\Controller\StatoCivile\StatoCivileFormController',
            'Admin\Controller\StatoCivile\StatoCivileOperations'                => 'Admin\Controller\StatoCivile\StatoCivileOperationsController',
            'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniSummary'    => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniSummaryController',
            'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniForm'       => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniFormController',

            /* Amm. trasparente */

            /* Atti concessione */
            'Admin\Controller\AttiConcessione\AttiConcessioneForm'              => 'Admin\Controller\AttiConcessione\AttiConcessioneFormController',
            'Admin\Controller\AttiConcessione\AttiConcessioneSummary'           => 'Admin\Controller\AttiConcessione\AttiConcessioneSummaryController',
            'Admin\Controller\AttiConcessione\ModalitaAssegnazioneForm'         => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneFormController',
            'Admin\Controller\AttiConcessione\ModalitaAssegnazioneSummary'      => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneSummaryController',

            /* Contratti Pubblici */
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSummary'       => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSummaryController',
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciForm'          => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciFormController',

            /* Enti Terzi */
            'Admin\Controller\EntiTerzi\EntiTerziFormController'                => 'Admin\Controller\EntiTerzi\EntiTerziFormController',
            'Admin\Controller\EntiTerzi\EntiTerziSummaryController'             => 'Admin\Controller\EntiTerzi\EntiTerziSummaryController',
            'Admin\Controller\EntiTerzi\InvioEnteTerzoController'               => 'Admin\Controller\EntiTerzi\InvioEnteTerzoController',

            /* Blogs */
            'Admin\Controller\Posts\BlogsCategoriesSummary'                     => 'Admin\Controller\Posts\BlogsCategoriesSummaryController',
            'Admin\Controller\Posts\BlogsSummaryController'                     => 'Admin\Controller\Posts\BlogsSummaryController',
            'Admin\Controller\Posts\BlogsFormController'                        => 'Admin\Controller\Posts\BlogsFormController',

            /* Photo */

            /* Sezioni */
            'Admin\Controller\SezioniPositionsUpdateController'                 => 'Admin\Controller\SezioniPositionsUpdateController',
            'Admin\Controller\SottoSezioniPositionsUpdateController'            => 'Admin\Controller\SottoSezioniPositionsUpdateController',

            /* Users */
            'Admin\Controller\Users\UsersSummary'                     => 'Admin\Controller\Users\UsersSummaryController',
            'Admin\Controller\Users\UsersForm'                        => 'Admin\Controller\Users\UsersFormController',

            'Admin\Controller\Users\RespProc\UsersRespProcController' => 'Admin\Controller\Users\RespProc\UsersRespProcController',
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
                    'contenuti-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'contenuti/form[/][:id[/]]',
                            'constraints' => array(
                                'module' => '[a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contenuti-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contenuti/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\contenuti\ContenutiSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'attachments-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'attachments/form/:module[/][:id[/]]',
                            'constraints' => array(
                                'module' => '[a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Attachments\AttachmentsForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'attachments-form-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'attachments/form/update/:module[/][:id[/]]',
                            'constraints' => array(
                                'module' => '[a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Attachments\AttachmentsFormUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-form-rettifica' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/form/rettifica[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioForm',
                                'action'     => 'rettifica',
                            ),
                        ),
                    ),
                    'albo-pretorio-sezioni-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio-sezioni/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioSezioniForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-sezioni-summary' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio-sezioni/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioSezioniSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-operations' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/operations/[:action[/]][:id[/]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioOperations',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'stato-civile-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\StatoCivileSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'stato-civile-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\StatoCivileForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'stato-civile-operations' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile/operations/:action/:id[/]',
                            'constraints' => array(
                                'id'        => '[0-9]+',
                                'action'    => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\StatoCivileOperations',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'stato-civile-sezioni-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile-sezioni/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'stato-civile-sezioni-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile-sezioni/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'atti-concessione-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'atti-concessione/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AttiConcessione\AttiConcessioneForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'atti-concessione-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'atti-concessione/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AttiConcessione\AttiConcessioneSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'atti-concessione-modalita-assegnazione-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'atti-concessione-modalita-assegnazione/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'atti-concessione-modalita-assegnazione-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'atti-concessione-modalita-assegnazione/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciForm',
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
                                'controller' => 'Admin\Controller\Posts\BlogsCategoriesSummary',
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
                                                'route'       => 'invio-ente-terzo/:module/:id[/]',
                                                'constraints' => array(
                                                        'module'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'id'         => '[0-9]+',
                                                ),
                                                'defaults' => array(
                                                        'controller' => 'Admin\Controller\EntiTerzi\InvioEnteTerzoController',
                                                        'action'     => 'index',
                                                ),
                                    ),
                    ),
                    'invio-ente-terzo-inviomail' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'invio-ente-terzo-sendmail/:modulename/:id[/]',
                            'constraints' => array(
                                'modulename' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\EntiTerzi\InvioEnteTerzoController',
                                'action'     => 'inviomail',
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
                    'albo-pretorio-relata-pdf' => array(
                                    'type'    => 'Segment',
                                    'options' => array(
                                                'route'         => 'albo-pretorio/relata/pdf/:id',
                                                'constraints'   => array(
                                                    'id' => '[0-9]+',
                                                ),
                                                'defaults' => array(
                                                    'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioRelataPdf',
                                                    'action'     => 'index',
                                                ),
                                    ),
                    ),
                    'users-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'users/summary[/][:categoryId[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'categoryId'  => '[0-9]+',
                                'page'        => '[0-9]+',
                                'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'       => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\UsersSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'users/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\UsersForm',
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
            'admin/attachments-form/index'                  => __DIR__ . '/../view/admin/empty.phtml',
            'admin/attachments-form-update/index'           => __DIR__ . '/../view/admin/empty.phtml',

            'admin/admin/formpost'                          => __DIR__ . '../../view/admin/formpost-empty.phtml',

            /* Contenuti */
            'admin/contenuti-summary/index'                 => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-form/index'                    => __DIR__ . '/../view/admin/empty.phtml',

            /* Albo pretorio */
            'admin/albo-pretorio-summary/index'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-form/index'                => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-pdf/relata'                => __DIR__ . '../../view/admin/albo-pretorio-pdf/relata.phtml',

            /* Stato civile */
            'admin/stato-civile-summary/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-form/index'                 => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-sezioni-summary/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-sezioni-form/index'         => __DIR__ . '/../view/admin/empty.phtml',

            /* Atti concessione */
            'admin/atti-concessione-form/index'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/atti-concessione-summary/index'          => __DIR__ . '/../view/admin/empty.phtml',
            'admin/modalita-assegnazione-form/index'        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/modalita-assegnazione-summary/index'     => __DIR__ . '/../view/admin/empty.phtml',

            /* Contratti pubblici */
            'admin/contratti-pubblici-summary/index'        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-form/index'           => __DIR__ . '/../view/admin/empty.phtml',

            /* Enti terzi */
            'admin/invio-ente-terzo/index'                  => __DIR__ . '/../view/admin/empty.phtml',

            /* Posts */
            'admin/blogs-summary/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-form/index'                        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-categories-summary/index'          => __DIR__ . '/../view/admin/empty.phtml',

            'admin/form-data-post/index'                    => __DIR__ . '../../view/admin/formpost-empty.phtml',

            'admin/admin/invio-ente-terzo'                  => __DIR__ . '/../view/invio-ente-terzo-empty.phtml',
            "admin/enti-terzi-summary/index"                => __DIR__ . '/../view/admin/empty.phtml',

            'admin/admin/config-edit'                       => __DIR__ . '/../view/config-edit-empty.phtml',
            'admin/admin/delete-element'                    => __DIR__ . '/../view/delete-element.phtml',

            'admin/admin/migrazione'                        => __DIR__ . '/../view/migrazione.phtml',

            'admin/sezioni-positions-update/index'          => __DIR__ . '/../view/admin/empty.phtml',

            'admin/sotto-sezioni-positions-update/index'    => __DIR__ . '/../view/admin/empty.phtml',

            'admin/users-summary/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/users-form/index'                        => __DIR__ . '/../view/admin/empty.phtml',

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
        'amministrazione-trasparente'           => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFormDataHandler',
        'configurations'                        => 'Admin\Model\Config\ConfigFormDataHandler',

        'sezioni-contenuti'                     => 'Admin\Model\Sezioni\SezioniFormDataHandler',

        'sottosezioni-contenuti'                => 'Admin\Model\Sezioni\SottoSezioniFormDataHandler',
        'sottosezioni-amm-trasparente'          => 'Admin\Model\Sezioni\SottoSezioniFormDataHandler',

        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteFormDataHandler',
        'contratti-pubblici-operatori'          => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriFormDataHandler',

        'tickets'                               => 'Admin\Model\Tickets\TicketsFormDataHandler',

        'users-settori'                         => 'Admin\Model\Users\Settori\UsersSettoriFormDataHandler',
    ),
    /* FormData CRUD Class Map */
    'formdata_crud_classmap' => array(
        'albo-pretorio'                                 => 'Admin\Model\AlboPretorio\AlboPretorioArticoliCrudHandler',
        'albo-pretorio-sezioni'                         => 'Admin\Model\AlboPretorio\AlboPretorioSezioniCrudHandler',
        'amministrazione-trasparente'                   => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteCrudHandler',
        'attachments'                                   => 'Admin\Model\Attachments\AttachmentsCrudHandler',
        'atti-concessione'                              => 'Admin\Model\AttiConcessione\AttiConcessioneCrudHandler',
        'atti-concessione-modalita-assegnazione-form'   => 'Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneCrudHandler',
        'blogs'                                         => 'Admin\Model\Posts\PostsCrudHandler',
        'categories'                                    => 'Admin\Model\Posts\CategoriesCrudHandler',
        'contenuti'                                     => 'Admin\Model\Contenuti\ContenutiCrudHandler',
        'configurations'                                => 'Admin\Model\Config\ConfigCrudHandler',
        'sezioni-contenuti'                             => 'Admin\Model\Sezioni\SezioniCrudHandler',
        'sottosezioni-contenuti'                        => 'Admin\Model\Sezioni\SottoSezioniCrudHandler',
        'contratti-pubblici'                            => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciCrudHandler',
        'contratti-pubblici-scelta-contraente'          => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteCrudHandler',
        'contratti-pubblici-operatori'                  => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriCrudHandler',
        'contatti'                                      => 'Admin\Model\Contacts\ContactsCrudHandler',
        'faq'                                           => 'Admin\Model\Faq\FaqCrudHandler',
        'newsletter'                                    => 'Admin\Model\Newsletter\NewsletterCrudHandler',
        'posts'                                         => 'Admin\Model\Posts\PostsCrudHandler',
        'enti-terzi'                                    => 'Admin\Model\EntiTerzi\EntiTerziCrudHandler',
        'stato-civile'                                  => 'Admin\Model\StatoCivile\StatoCivileCrudHandler',
        'stato-civile-sezioni'                          => 'Admin\Model\StatoCivile\StatoCivileSezioniCrudHandler',
        'tickets'                                       => 'Admin\Model\Tickets\TicketsCrudHandler',
        'users'                                         => 'Admin\Model\Users\UsersCrudHandler',
        'users-roles'                                   => 'Admin\Model\Users\Roles\UsersRolesCrudHandler',
        'users-settori'                                 => 'Admin\Model\Users\Settori\UsersSettoriCrudHandler',
        'users-todo'                                    => 'Admin\Model\Users\Roles\UsersTodoCrudHandler',
    ),
    /* DataTables Class Map */
    'datatables_classmap' => array(
        'tickets'                               => 'Admin\Model\Tickets\TicketsDataTable',
        'contacts'                              => 'Admin\Model\Contacts\ContactsDataTable',
        'faq'                                   => 'Admin\Model\Faq\FaqDataTable',
        'newsletter'                            => 'Admin\Model\Newsletter\NewsletterDataTable',
        'logs'                                  => 'Admin\Model\Logs\LogsDataTable',

        'sezioni-contenuti'                     => 'Admin\Model\Sezioni\SezioniDataTable',
        'sottosezioni-contenuti'                => 'Admin\Model\Sezioni\SottosezioniContenutiDataTable',
        'sottosezioni-amm-trasparente'          => 'Admin\Model\Sezioni\SottosezioniAmmTrasparenteDataTable',

        'amministrazione-trasparente'           => 'Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteDataTable',

        'atti-ufficiali'                        => 'Admin\Model\AlboPretorio\AttiUfficialiDataTable',

        'contratti-pubblici-scelta-contraente'  => 'Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteDataTable',
        'contratti-pubblici-operatori'          => 'Admin\Model\ContrattiPubblici\Operatori\OperatoriDataTable',

        'users-roles'                           => 'Admin\Model\Users\Roles\UsersRolesDataTable',
        'users-settori'                         => 'Admin\Model\Users\Settori\UsersSettoriDataTable',
        'users-resp-procedimento'               => 'Admin\Model\Users\Roles\UsersRespProcDataTable',
    ),
);
