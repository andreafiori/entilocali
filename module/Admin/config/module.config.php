<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin'                                            => 'Admin\Controller\AdminController',
            'Admin\Controller\Configurations\ConfigurationsForm'                => 'Admin\Controller\Configurations\ConfigurationsFormController',

            /* Attachment files */
            'Admin\Controller\Attachments\AttachmentsSummary'                   => 'Admin\Controller\Attachments\AttachmentsSummaryController',
            'Admin\Controller\Attachments\AttachmentsForm'                      => 'Admin\Controller\Attachments\AttachmentsFormController',
            'Admin\Controller\Attachments\AttachmentsPositions'                 => 'Admin\Controller\Attachments\AttachmentsPositionsController',
            'Admin\Controller\Attachments\AttachmentsFormUpdate'                => 'Admin\Controller\Attachments\AttachmentsFormUpdateController',

            /* Insert and update Ajax POSTs */
            'Admin\Controller\FormDataPost'                                     => 'Admin\Controller\FormDataPostController',

            /* Contenuti */
            'Admin\Controller\Contenuti\ContenutiSummary'                       => 'Admin\Controller\Contenuti\ContenutiSummaryController',
            'Admin\Controller\Contenuti\ContenutiForm'                          => 'Admin\Controller\Contenuti\ContenutiFormController',
            'Admin\Controller\Contenuti\ContenutiEnableDisable'                 => 'Admin\Controller\Contenuti\ContenutiEnableDisableController',
            'Admin\Controller\Contenuti\ContenutiHomeputremove'                 => 'Admin\Controller\Contenuti\ContenutiHomeputremoveController',
            'Admin\Controller\Contenuti\ContenutiOperations'                    => 'Admin\Controller\Contenuti\ContenutiOperationsController',
            'Admin\Controller\Contenuti\ContenutiInsert'                        => 'Admin\Controller\Contenuti\ContenutiInsertController',
            'Admin\Controller\Contenuti\ContenutiUpdate'                        => 'Admin\Controller\Contenuti\ContenutiUpdateController',
            'Admin\Controller\Contenuti\ContenutiTabellaForm'                   => 'Admin\Controller\Contenuti\ContenutiTabellaFormController',

            /* Albo Pretorio */
            'Admin\Controller\AlboPretorio\AlboPretorioSummary'                 => 'Admin\Controller\AlboPretorio\AlboPretorioSummaryController',
            'Admin\Controller\AlboPretorio\AlboPretorioForm'                    => 'Admin\Controller\AlboPretorio\AlboPretorioFormController',
            'Admin\Controller\AlboPretorio\AlboPretorioInsert'                  => 'Admin\Controller\AlboPretorio\AlboPretorioInsertController',
            'Admin\Controller\AlboPretorio\AlboPretorioUpdate'                  => 'Admin\Controller\AlboPretorio\AlboPretorioUpdateController',
            'Admin\Controller\AlboPretorio\AlboPretorioFormRettifica'           => 'Admin\Controller\AlboPretorio\AlboPretorioFormRettificaController',
            'Admin\Controller\AlboPretorio\AlboPretorioOperations'              => 'Admin\Controller\AlboPretorio\AlboPretorioOperationsController',
            'Admin\Controller\AlboPretorio\AlboPretorioRelataPdf'               => 'Admin\Controller\AlboPretorio\AlboPretorioRelataPdfController',
            'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniForm'     => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniFormController',
            'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniSummary'  => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniSummaryController',
            'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniInsert'   => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniInsertController',
            'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniUpdate'   => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniUpdateController',

            /* Stato Civile */
            'Admin\Controller\StatoCivile\StatoCivileSummary'                   => 'Admin\Controller\StatoCivile\StatoCivileSummaryController',
            'Admin\Controller\StatoCivile\StatoCivileForm'                      => 'Admin\Controller\StatoCivile\StatoCivileFormController',
            'Admin\Controller\StatoCivile\StatoCivileInsert'                    => 'Admin\Controller\StatoCivile\StatoCivileInsertController',
            'Admin\Controller\StatoCivile\StatoCivileUpdate'                    => 'Admin\Controller\StatoCivile\StatoCivileUpdateController',
            'Admin\Controller\StatoCivile\StatoCivileDelete'                    => 'Admin\Controller\StatoCivile\StatoCivileDeleteController',
            'Admin\Controller\StatoCivile\StatoCivileOperations'                => 'Admin\Controller\StatoCivile\StatoCivileOperationsController',
            'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniSummary'    => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniSummaryController',
            'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniForm'       => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniFormController',
            'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniInsert'     => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniInsertController', // to create
            'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniUpdate'     => 'Admin\Controller\StatoCivile\Sezioni\StatoCivileSezioniUpdateController', // to create

            /* Amministrazione trasparente */

            /* Atti concessione */
            'Admin\Controller\AttiConcessione\AttiConcessioneForm'              => 'Admin\Controller\AttiConcessione\AttiConcessioneFormController',
            'Admin\Controller\AttiConcessione\AttiConcessioneSummary'           => 'Admin\Controller\AttiConcessione\AttiConcessioneSummaryController',
            'Admin\Controller\AttiConcessione\AttiConcessioneInsert'            => 'Admin\Controller\AttiConcessione\AttiConcessioneInsertController', // to create
            'Admin\Controller\AttiConcessione\AttiConcessioneUpdate'            => 'Admin\Controller\AttiConcessione\AttiConcessioneUpdateController', // to create
            'Admin\Controller\AttiConcessione\ModalitaAssegnazioneForm'         => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneFormController',
            'Admin\Controller\AttiConcessione\ModalitaAssegnazioneSummary'      => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneSummaryController',
            'Admin\Controller\AttiConcessione\ModalitaAssegnazioneInsert'       => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneInsert', // to create
            'Admin\Controller\AttiConcessione\ModalitaAssegnazioneUpdate'       => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneUpdate', // to create

            /* Contratti Pubblici */
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSummary'                    => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSummaryController',
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciForm'                       => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciFormController',
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciInsert'                     => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciInsertController',
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciUpdate'                     => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciUpdateController',
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteForm'       => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteFormController',
            'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteSummary'    => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteSummaryController',
            'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriForm'    => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriFormController',
            'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriSummary' => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriSummaryController',
            'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriInsert'  => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriInsertController',
            'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriUpdate'  => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriUpdateController',

            /* Enti Terzi */
            'Admin\Controller\EntiTerzi\EntiTerziForm'              => 'Admin\Controller\EntiTerzi\EntiTerziFormController',
            'Admin\Controller\EntiTerzi\EntiTerziSummary'           => 'Admin\Controller\EntiTerzi\EntiTerziSummaryController',
            'Admin\Controller\EntiTerzi\EntiTerziInsert'            => 'Admin\Controller\EntiTerzi\EntiTerziInsertController', // to create
            'Admin\Controller\EntiTerzi\EntiTerziUpdate'            => 'Admin\Controller\EntiTerzi\EntiTerziUpdateController', // to create
            'Admin\Controller\EntiTerzi\InvioEnteTerzoController'   => 'Admin\Controller\EntiTerzi\InvioEnteTerzoController',

            /* Blogs */
            'Admin\Controller\Blogs\BlogsCategoriesForm'             => 'Admin\Controller\Blogs\BlogsCategoriesFormController',
            'Admin\Controller\Blogs\BlogsCategoriesSummary'          => 'Admin\Controller\Blogs\BlogsCategoriesSummaryController',
            'Admin\Controller\Blogs\BlogsSummary'                    => 'Admin\Controller\Blogs\BlogsSummaryController',
            'Admin\Controller\Blogs\BlogsForm'                       => 'Admin\Controller\Blogs\BlogsFormController',
            'Admin\Controller\Blogs\Blogs'                           => 'Admin\Controller\Blogs\BlogsController',

            /* Photo */
            'Admin\Controller\Photo\PhotoForm'                        => 'Admin\Controller\Photo\PhotoFormController',
            'Admin\Controller\Photo\PhotoSummary'                     => 'Admin\Controller\Photo\PhotoSummaryController',
            'Admin\Controller\Photo\PhotoInsert'                      => 'Admin\Controller\Photo\PhotoInsertController',
            'Admin\Controller\Photo\PhotoUpdate'                      => 'Admin\Controller\Photo\PhotoUpdateController',
            'Admin\Controller\Photo\PhotoDelete'                      => 'Admin\Controller\Photo\PhotoDeleteController',

            /* Sezioni */
            'Admin\Controller\Sezioni\SezioniForm'                    => 'Admin\Controller\Sezioni\SezioniFormController',
            'Admin\Controller\Sezioni\SezioniSummary'                 => 'Admin\Controller\Sezioni\SezioniSummaryController',
            'Admin\Controller\Sezioni\SezioniOperations'              => 'Admin\Controller\Sezioni\SezioniOperationsController',
            'Admin\Controller\Sezioni\SezioniPositions'               => 'Admin\Controller\Sezioni\SezioniPositionsController',
            'Admin\Controller\Sezioni\SezioniPositionsUpdate'         => 'Admin\Controller\SezioniPositionsUpdateController',
            'Admin\Controller\Sezioni\SezioniInsert'                  => 'Admin\Controller\Sezioni\SezioniInsertController',
            'Admin\Controller\Sezioni\SezioniUpdate'                  => 'Admin\Controller\Sezioni\SezioniUpdateController',

            /* Sottosezioni */
            'Admin\Controller\Sezioni\SottoSezioniSummary'            => 'Admin\Controller\Sezioni\SottoSezioniSummaryController',
            'Admin\Controller\Sezioni\SottoSezioniForm'               => 'Admin\Controller\Sezioni\SottoSezioniFormController',
            'Admin\Controller\Sezioni\SottoSezioniInsert'             => 'Admin\Controller\Sezioni\SottoSezioniInsertController', // to create
            'Admin\Controller\Sezioni\SottoSezioniUpdate'             => 'Admin\Controller\Sezioni\SottoSezioniUpdateController', // to create
            'Admin\Controller\Sezioni\SottoSezioniPositions'          => 'Admin\Controller\Sezioni\SottoSezioniPositionsController',
            'Admin\Controller\Sezioni\SottoSezioniPositionsUpdate'    => 'Admin\Controller\Sezioni\SottoSezioniPositionsUpdateController',
            'Admin\Controller\Sezioni\SottoSezioniOperations'         => 'Admin\Controller\Sezioni\SottoSezioniOperationsController',

            /* Users */
            'Admin\Controller\Users\UsersSummary'                     => 'Admin\Controller\Users\UsersSummaryController',
            'Admin\Controller\Users\UsersForm'                        => 'Admin\Controller\Users\UsersFormController',

            /* Users Roles */
            'Admin\Controller\Users\Roles\UsersRolesForm'             => 'Admin\Controller\Users\Roles\UsersRolesFormController',
            'Admin\Controller\Users\Roles\UsersRolesSummary'          => 'Admin\Controller\Users\Roles\UsersRolesSummaryController',

            /* Users Settori */
            'Admin\Controller\Users\Settori\SettoriSummary'           => 'Admin\Controller\Users\Settori\SettoriSummaryController',
            'Admin\Controller\Users\Settori\SettoriForm'              => 'Admin\Controller\Users\Settori\SettoriFormController',
            'Admin\Controller\Users\Settori\SettoriInsert'            => 'Admin\Controller\Users\Settori\SettoriInsertController',
            'Admin\Controller\Users\Settori\SettoriUpdate'            => 'Admin\Controller\Users\Settori\SettoriUpdateController',

            /* Users responsabili procedimento */
            'Admin\Controller\Users\RespProc\UsersRespProc'           => 'Admin\Controller\Users\RespProc\UsersRespProcController',

            /* Gestione home page */
            'Admin\Controller\HomePage\HomePageBlocksPositions'       => 'Admin\Controller\HomePage\HomePageBlocksPositionsController',
            'Admin\Controller\HomePage\HomePage'                      => 'Admin\Controller\HomePage\HomePageController', // to rename

            /* Tickets */
            'Admin\Controller\Tickets\TicketsForm'                    => 'Admin\Controller\Tickets\TicketsFormController',
            'Admin\Controller\Tickets\TicketsSummary'                 => 'Admin\Controller\Tickets\TicketsSummaryController',

            /* Contacts */
            'Admin\Controller\Contacts\ContactsSummary'               => 'Admin\Controller\Contacts\ContactsSummaryController',

            /* Logs */
            'Admin\Controller\Log\LogSummary'                         => 'Admin\Controller\Log\LogSummaryController',
            'Admin\Controller\Log\LogOperations'                      => 'Admin\Controller\Log\LogOperationsController',
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
                    'ajax-pform-trial' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'trial/form/ajax/:action[/]',
                            'constraints' => array(
                                'action' => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\FormAjaxTrial',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'configurations-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'configurations/form/lang/:languageSelection[/]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Configurations\ConfigurationsForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contacts-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contacts/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'page'              => '[0-9]+',
                                'order_by'          => '[a-zA-Z0-9_-]*',
                                'order'             => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contacts\ContactsSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'log-summary' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'logs/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'page'              => '[0-9]+',
                                'order_by'          => '[a-zA-Z0-9_-]*',
                                'order'             => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Log\LogSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'log-operations' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'logs/operations/:action[/]',
                            'constraints' => array(
                                'action' => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Log\LogOperations',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'homepage-management' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'homepage/management[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\HomePage\HomePage',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'homepage-positions' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'homepage/management/positions[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\HomePage\HomePage',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'homepage-blocks-positions' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'homepage/blocks/positions[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\HomePage\HomePageBlocksPositions',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'homepage-blocks-positions-update' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'homepage/blocks/positions/update[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\HomePage\HomePageBlocksPositions',
                                'action'     => 'update',
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
                    'contenuti-operations' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'contenuti/operations/:action[/][:id[/]]',
                            'constraints' => array(
                                'action'    => '[a-zA-Z0-9_-]*',
                                'id'        => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiOperations',
                            ),
                        ),
                    ),
                    'contenuti-homeputremove' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'contenuti/homepage/management/:action/:id[/]',
                            'constraints' => array(
                                'action' => '[a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiHomeputremove',
                            ),
                        ),
                    ),
                    'contenuti-enabledisable' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'contenuti/operations/lang/:languageSelection/:action/:id[/][previouspage/:previouspage[/]]',
                            'constraints' => array(
                                'action'            => '[a-zA-Z0-9_-]*',
                                'languageSelection' => '[a-z]{2}',
                                'previouspage'      => '[0-9]+',
                                'id'                => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiEnableDisable',
                            ),
                        ),
                    ),
                    'contenuti-summary' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'common/module/:modulename/summary/lang/:languageSelection[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'order_by'          => '[a-zA-Z0-9_-]*',
                                'order'             => '[a-zA-Z0-9_-]*',
                                'page'              => '[0-9]+',
                                'languageSelection' => '[a-z]{2}',
                                'modulename'        => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contenuti-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'common/module/:modulename/form/lang/:languageSelection[/][:id[/]][previouspage/:previouspage[/]]',
                            'constraints' => array(
                                'modulename'            => '(contenuti|amministrazione-trasparente)',
                                'id'                    => '[0-9]+',
                                'languageSelection'     => '[a-z]{2}',
                                'previouspage'          => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contenuti-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'common/form/:modulename/lang/:languageSelection/insert[/]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                                'modulename'        => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contenuti-update' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'common/form/:modulename/lang/:languageSelection/update[/]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                                'modulename'        => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'amministrazione-trasparente-tabella' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'common/amministrazione-trasparente/tabella/form/lang/:languageSelection/:id[/][previouspage/:previouspage[/]]',
                            'constraints' => array(
                                'id'                => '[0-9]+',
                                'languageSelection' => '[a-z]{2}',
                                'modulename'        => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Contenuti\ContenutiTabellaForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sezioni-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'sezioni/summary/:modulename/lang/:languageSelection[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'page'              => '[0-9]+',
                                'order_by'          => '[a-zA-Z0-9_-]*',
                                'order'             => '[a-zA-Z0-9_-]*',
                                'languageSelection' => '[a-z]{2}',
                                'modulename'        => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SezioniSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sezioni-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'sezioni/form/:modulename/lang/:languageSelection[/][:id[/]][previouspage/:previouspage[/]]',
                            'constraints' => array(
                                'id'                 => '[0-9]+',
                                'languageSelection'  => '[a-z]{2}',
                                'previouspage'       => '[0-9]+',
                                'modulename'         => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SezioniForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sezioni-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'sezioni/:modulename/form/lang/:languageSelection/insert[/]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                                'modulename'        => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SezioniInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sezioni-update' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'sezioni/:modulename/form/lang/:languageSelection/update/',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SezioniUpdate',
                                'action'     => 'index',
                                'modulename'         => '(contenuti|amministrazione-trasparente)',
                            ),
                        ),
                    ),
                    'sottosezioni-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'sottosezioni/:modulename/summary/lang/:languageSelection[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'page'              => '[0-9]+',
                                'order_by'          => '[a-zA-Z0-9_-]*',
                                'order'             => '[a-zA-Z0-9_-]*',
                                'languageSelection' => '[a-z]{2}',
                                'modulename'        => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SottoSezioniSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sottosezioni-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'sottosezioni/:modulename/form/lang/:languageSelection[/][:id[/]][previouspage/:previouspage[/]]',
                            'constraints' => array(
                                'id'                 => '[0-9]+',
                                'languageSelection'  => '[a-z]{2}',
                                'previouspage'       => '[0-9]+',
                                'modulename'         => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SottoSezioniForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sottosezioni-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'sottosezioni/:modulename/lang/:languageSelection/form/insert[/]',
                            'constraints' => array(
                                'modulename' => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SottoSezioniInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sottosezioni-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'sottosezioni/:modulename/lang/:languageSelection/form/update[/]',
                            'constraints' => array(
                                'modulename' => '(contenuti|amministrazione-trasparente)',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SottoSezioniUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'sottosezioni-operations' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'sottosezioni/operations/lang/:languageSelection/:action[/][:id[/]][previouspage/:previouspage[/]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SottoSezioniOperations',
                            ),
                        ),
                    ),
                    'sezioni-operations' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'sezioni/operations/lang/:languageSelection/:action[/][:id[/]][previouspage/:previouspage[/]]',
                            'constraints' => array(
                                'action'            => '[a-zA-Z0-9_-]*',
                                'id'                => '[0-9]+',
                                'languageSelection' => '[a-z]{2}',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SezioniOperations',
                            ),
                        ),
                    ),
                    'attachments-summary' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'attachments/summary/:module/:referenceId[/]',
                            'constraints' => array(
                                'module'        => '[a-zA-Z0-9_-]*',
                                'referenceId'   => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Attachments\AttachmentsSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'attachments-positions' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'attachments/positions/:module/:referenceId[/]',
                            'constraints' => array(
                                'module'        => '[a-zA-Z0-9_-]*',
                                'referenceId'   => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Attachments\AttachmentsPositions',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'attachments-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'attachments/form/:module/:referenceId[/][:attachmentId[/]]',
                            'constraints' => array(
                                'module'        => '[a-zA-Z0-9_-]*',
                                'referenceId'   => '[0-9]+',
                                'attachmentId'  => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Attachments\AttachmentsForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'attachments-form-big-files' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'attachments/form/big/files/:module/:referenceId[/][:attachmentId[/]]',
                            'constraints' => array(
                                'module'        => '[a-zA-Z0-9_-]*',
                                'referenceId'   => '[0-9]+',
                                'attachmentId'  => '[0-9]+',
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
                            'constraints' => array(
                                'order_by'  => '[a-zA-Z0-9_-]*',
                                'order'     => '[a-zA-Z0-9_-]*',
                                'page'      => '[0-9]+',
                            ),
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
                    'albo-pretorio-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/atti/form/insert[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/atti/form/update[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-form-rettifica' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/atti/form/rettifica[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\AlboPretorioFormRettifica',
                                'action'     => 'index',
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
                                'controller' => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-sezioni-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/sezioni/form/insert[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-sezioni-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/sezioni/form/update[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-sezioni-delete' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio/sezioni/form/delete[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniDelete',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'albo-pretorio-sezioni-summary' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'albo-pretorio-sezioni/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'order_by' => '[a-zA-Z0-9_-]*',
                                'order' => '[a-zA-Z0-9_-]*',
                                'page'  => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AlboPretorio\Sezioni\AlboPretorioSezioniSummary',
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
                    'stato-civile-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'order_by' => '[a-zA-Z0-9_-]*',
                                'order' => '[a-zA-Z0-9_-]*',
                                'page'     => '[0-9]+',
                            ),
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
                    'stato-civile-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile/atti/form/insert[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\StatoCivileInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'stato-civile-update' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile/atti/form/update[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\StatoCivileUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'stato-civile-delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'stato-civile/atti/form/delete[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\StatoCivile\StatoCivileDelete',
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
                            'constraints' => array(
                                'order_by' => '[a-zA-Z0-9_-]*',
                                'order' => '[a-zA-Z0-9_-]*',
                                'page'     => '[0-9]+',
                            ),
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
                            'constraints' => array(
                                'order_by' => '[a-zA-Z0-9_-]*',
                                'order' => '[a-zA-Z0-9_-]*',
                                'page'     => '[0-9]+',
                            ),
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
                            'constraints' => array(
                                'order_by' => '[a-zA-Z0-9_-]*',
                                'order' => '[a-zA-Z0-9_-]*',
                                'page'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'atti-concessione-modalita-assegnazione-insert' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'atti-concessione/modalita-assegnazione/insert[/]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'atti-concessione-modalita-assegnazione-update' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'atti-concessione/modalita-assegnazione/update[/]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\AttiConcessione\ModalitaAssegnazioneUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'order_by' => '[a-zA-Z0-9_-]*',
                                'order' => '[a-zA-Z0-9_-]*',
                                'page'     => '[0-9]+',
                            ),
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
                    'contratti-pubblici-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/form/insert[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/form/update[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-scelta-contraente-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/scelta-contraente/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'order_by'  => '[a-zA-Z0-9_-]*',
                                'order'     => '[a-zA-Z0-9_-]*',
                                'page'      => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-scelta-contraente-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/scelta-contraente/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\ContrattiPubbliciSceltaContraenteForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-operatori-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/operatori/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-operatori-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/operatori/form/insert[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-operatori-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/operatori/form/update[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-operatori-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'contratti-pubblici/operatori/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'order_by' => '[a-zA-Z0-9_-]*',
                                'order' => '[a-zA-Z0-9_-]*',
                                'page'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\ContrattiPubblici\Operatori\ContrattiPubbliciOperatoriSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'contratti-pubblici-aggiudicatari' => array(
                        'type' => 'Segment',
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
                    'enti-terzi-summary' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'enti-terzi/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'page'        => '[0-9]+',
                                'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'       => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\EntiTerzi\EntiTerziSummary',
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
                                'controller' => 'Admin\Controller\EntiTerzi\EntiTerziForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'enti-terzi-insert' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'enti-terzi/rubrica/form/insert[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\EntiTerzi\EntiTerziInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'enti-terzi-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'enti-terzi/rubrica/form/update[/]',
                            'constraints' => array(

                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\EntiTerzi\EntiTerziUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'blogs-categories-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'posts/categories/lang/:languageSelection/summary/:moduleCode[/][:categoryId[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                                'moduleCode'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'categoryId'        => '[0-9]+',
                                'page'              => '[0-9]+',
                                'order_by'          => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'             => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Blogs\BlogsCategoriesSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'blogs-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'blogs/lang/:languageSelection/form/:formtype[/][:id[/]]',
                            'constraints' => array(
                                'formtype'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'        => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Blogs\BlogsForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'blogs-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'blogs/summary/lang/:languageSelection[/][:categoryId[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                                'categoryId'        => '[0-9]+',
                                'page'              => '[0-9]+',
                                'order_by'          => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'             => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Blogs\BlogsSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'blogs-operations' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'blogs/lang/:languageSelection/operations/:action[/]',
                            'constraints' => array(
                                'action'            => '[a-zA-Z0-9_-]*',
                                'languageSelection' => '[a-z]{2}',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Blogs\BlogsOperations',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'photo-summary' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'photo/lang/:languageSelection/summary[/][:categoryId[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                                'categoryId'        => '[0-9]+',
                                'page'              => '[0-9]+',
                                'order_by'          => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'             => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Photo\PhotoSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'photo-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'photo/lang/:languageSelection/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'languageSelection' => '[a-z]{2}',
                                'controller'        => 'Admin\Controller\Photo\PhotoForm',
                                'action'            => 'index',
                            ),
                        ),
                    ),
                    'tickets-form' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'tickets/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Tickets\TicketsForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'tickets-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'tickets/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'order_by'  => '[a-zA-Z0-9_-]*',
                                'order'     => '[a-zA-Z0-9_-]*',
                                'page'      => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Tickets\TicketsSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'datatable' => array(
                                    'type' => 'Segment',
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
                    'migrazione' => array(
                        'type' => 'Segment',
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
                                    'type' => 'Segment',
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
                    'sezioni-positions' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'posizioni/sezioni/:modulename/lang/:languageSelection[/]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SezioniPositions',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'posizioni-sezioni-update' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'posizioni/sezioni/update[/]',
                            'constraints' => array(),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SezioniPositionsUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'posizioni-sottosezioni' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'       => 'sottosezioni/posizioni/:modulename/lang/:languageSelection/:sezioneId[/][:profonditaDa[/]]',
                            'constraints' => array(
                                'languageSelection' => '[a-z]{2}',
                                'sezioneId'         => '[0-9]+',
                                'profonditaDa'      => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Sezioni\SottoSezioniPositions',
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
                                'controller' => 'Admin\Controller\Sezioni\SottoSezioniPositionsUpdate',
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
                    'users-roles-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'users/roles/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\Roles\UsersRolesForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-roles-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'users/roles/summary[/][:categoryId[/]][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'categoryId'  => '[0-9]+',
                                'page'        => '[0-9]+',
                                'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'       => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\Roles\UsersRolesSummary',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-settori-form' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => 'users/settori/form[/][:id[/]]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\Settori\SettoriForm',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-settori-insert' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'users/settori/insert[/]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\Settori\SettoriInsert',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-settori-update' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'users/settori/update[/]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\Settori\SettoriUpdate',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-settori-delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'users/settori/delete[/]',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\Settori\SettoriDelete',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-settori-summary' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => 'users/settori/summary[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                            'constraints' => array(
                                'page'        => '[0-9]+',
                                'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order'       => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\Settori\SettoriSummary',
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
                    'users-responsabili-procedimento' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'users/responsabili-procedimento/management[/]',
                            'constraints' => array(),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\RespProc\UsersRespProc',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'users-responsabili-procedimento-operations' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'users/responsabili-procedimento/operations/:action[/]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Users\RespProc\UsersRespProc',
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
        'display_exceptions' => true,
        'template_map' => array(
            'admin/admin/login'                             => __DIR__ . '../../view/admin/auth/login.phtml',
            'admin/admin/index'                             => __DIR__ . '../../view/admin/index.phtml',

            'admin/attachments-form/index'                  => __DIR__ . '/../view/admin/empty.phtml',
            'admin/attachments-form-update/index'           => __DIR__ . '/../view/admin/empty.phtml',

            'admin/admin/formpost'                          => __DIR__ . '../../view/admin/formpost-empty.phtml',

            /* Contenuti */
            'admin/contenuti-summary/index'                 => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-form/index'                    => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-insert/index'                  => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-update/index'                  => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-enabledisable/enable'          => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-enabledisable/disable'         => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-homeputremove/put'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-homeputremove/remove'          => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-operations/insert'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-operations/update'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-operations/delete'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-operations/changesummarylang'  => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-operations/summarysearch'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contenuti-tabella-form/index'            => __DIR__ . '/../view/admin/empty.phtml',

            /* Amministrazione trasparente */

            /* Albo pretorio */
            'admin/albo-pretorio-summary/index'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-form/index'                => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-insert/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-update/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-delete/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-pdf/relata'                => __DIR__ . '../../view/admin/albo-pretorio-pdf/relata.phtml',
            'admin/albo-pretorio-sezioni-form/index'        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-sezioni-insert/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-sezioni-update/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-sezioni-delete/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/albo-pretorio-sezioni-summary/index'     => __DIR__ . '/../view/admin/empty.phtml',

            /* Stato civile */
            'admin/stato-civile-summary/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-form/index'                 => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-insert/index'               => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-update/index'               => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-delete/index'               => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-sezioni-summary/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-sezioni-form/index'         => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-sezioni-insert/index'       => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-sezioni-update/index'       => __DIR__ . '/../view/admin/empty.phtml',
            'admin/stato-civile-sezioni-delete/index'       => __DIR__ . '/../view/admin/empty.phtml',

            /* Atti concessione */
            'admin/atti-concessione-form/index'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/atti-concessione-insert/index'           => __DIR__ . '/../view/admin/empty.phtml',
            'admin/atti-concessione-update/index'           => __DIR__ . '/../view/admin/empty.phtml',
            'admin/atti-concessione-delete/index'           => __DIR__ . '/../view/admin/empty.phtml',
            'admin/atti-concessione-summary/index'          => __DIR__ . '/../view/admin/empty.phtml',
            'admin/modalita-assegnazione-form/index'        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/modalita-assegnazione-insert/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/modalita-assegnazione-update/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/modalita-assegnazione-delete/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/modalita-assegnazione-summary/index'     => __DIR__ . '/../view/admin/empty.phtml',

            /* Contratti pubblici */
            'admin/contratti-pubblici-summary/index'                    => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-form/index'                       => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-insert/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-update/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-delete/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-operatori-summary/index'          => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-operatori-form/index'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-operatori-insert/index'           => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-operatori-update/index'           => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-operatori-delete/index'           => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-scelta-contraente-form/index'     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-scelta-contraente-insert/index'   => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-scelta-contraente-update/index'   => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-scelta-contraente-delete/index'   => __DIR__ . '/../view/admin/empty.phtml',
            'admin/contratti-pubblici-scelta-contraente-summary/index'  => __DIR__ . '/../view/admin/empty.phtml',

            /* Enti terzi */
            "admin/enti-terzi-form/index"                   => __DIR__ . '/../view/admin/empty.phtml',
            "admin/enti-terzi-insert/index"                 => __DIR__ . '/../view/admin/empty.phtml',
            "admin/enti-terzi-update/index"                 => __DIR__ . '/../view/admin/empty.phtml',
            "admin/enti-terzi-delete/index"                 => __DIR__ . '/../view/admin/empty.phtml',
            "admin/enti-terzi-summary/index"                => __DIR__ . '/../view/admin/empty.phtml',
            'admin/invio-ente-terzo/index'                  => __DIR__ . '/../view/admin/empty.phtml',

            /* Blogs */
            'admin/blogs-summary/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-form/index'                        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-insert/index'                      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-update/index'                      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-delete/index'                      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/blogs-categories-summary/index'          => __DIR__ . '/../view/admin/empty.phtml',

            /* Photo */
            'admin/photo-form/index'                        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/photo-summary/index'                     => __DIR__ . '/../view/admin/empty.phtml',

            'admin/form-data-post/index'                    => __DIR__ . '../../view/admin/formpost-empty.phtml',

            'admin/admin/migrazione'                        => __DIR__ . '/../view/migrazione.phtml',

            /* Sezioni */
            'admin/sezioni-form/index'                      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sezioni-summary/index'                   => __DIR__ . '/../view/admin/empty.phtml',
            'admin/posizioni-sezioni/index'                 => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sezioni-positions/index'                 => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sezioni-positions-update/index'          => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sezioni-insert/index'                    => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sezioni-update/index'                    => __DIR__ . '/../view/admin/empty.phtml',

            /* SottoSezioni */
            'admin/sotto-sezioni-contenuti-summary/index'   => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-form/index'                => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-summary/index'             => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-insert/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-update/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-delete/index'              => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-positions-update/index'    => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-amm-trasp-form/index'      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/sotto-sezioni-positions/index'           => __DIR__ . '/../view/admin/empty.phtml',

            /* Users */
            'admin/users-summary/index'                     => __DIR__ . '/../view/admin/empty.phtml',
            'admin/users-form/index'                        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/users-roles-form/index'                  => __DIR__ . '/../view/admin/empty.phtml',
            'admin/users-roles-summary/index'               => __DIR__ . '/../view/admin/empty.phtml',
            'admin/users-resp-proc/index'                   => __DIR__ . '/../view/admin/empty.phtml',

            /* Settori */
            'admin/settori-form/index'                      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/settori-summary/index'                   => __DIR__ . '/../view/admin/empty.phtml',
            'admin/settori-insert/index'                    => __DIR__ . '/../view/admin/empty.phtml',
            'admin/settori-update/index'                    => __DIR__ . '/../view/admin/empty.phtml',

            /* Home page */
            'admin/home-page/index'                         => __DIR__ . '/../view/admin/empty.phtml',
            'admin/home-page-blocks-positions/index'        => __DIR__ . '/../view/admin/empty.phtml',
            'admin/home-page-blocks-positions/update'       => __DIR__ . '/../view/admin/empty.phtml',

            /* Ticket */
            'admin/tickets-form/index'                      => __DIR__ . '/../view/admin/empty.phtml',
            'admin/tickets-summary/index'                   => __DIR__ . '/../view/admin/empty.phtml',

            'admin/'                                        => __DIR__ . '/../view/admin/empty.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view/',
            __DIR__ . '../../public',
            __DIR__ . '../../../public',
        ),
    ),
    /* Backend Router Class Map */
    'be_router' => array(
        "admin/migrazione"                       => '\ModelModule\Model\Migrazione\MigrazioneHandler',
        "admin/contratti-pubblici-aggiudicatari" => '\ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariHandler',
        "admin/users-resp-proc-management"       => '\ModelModule\Model\Users\RespProc\UsersRespProcHandler',
    ),
    /* FormData CRUD Class Map */
    'formdata_crud_classmap' => array(
        'attachments'                                   => 'ModelModule\Model\Attachments\AttachmentsCrudHandler',
        'atti-concessione'                              => 'ModelModule\Model\AttiConcessione\AttiConcessioneCrudHandler',
        'atti-concessione-modalita-assegnazione-form'   => 'ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneCrudHandler',
        'blogs'                                         => 'ModelModule\Model\Posts\PostsCrudHandler',
        'categories'                                    => 'ModelModule\Model\Posts\PostsCategoriesCrudHandler',
        'contratti-pubblici-scelta-contraente'          => 'ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteCrudHandler',
        'contratti-pubblici-operatori'                  => 'ModelModule\Model\ContrattiPubblici\Operatori\OperatoriCrudHandler',
        'posts'                                         => 'ModelModule\Model\Posts\PostsCrudHandler',
        'stato-civile-sezioni'                          => 'ModelModule\Model\StatoCivile\StatoCivileSezioniCrudHandler',
        'users'                                         => 'ModelModule\Model\Users\UsersCrudHandler',
        'users-roles'                                   => 'ModelModule\Model\Users\Roles<\UsersRolesCrudHandler',
        'users-settori'                                 => 'ModelModule\Model\Users\Settori\UsersSettoriCrudHandler',
        'users-todo'                                    => 'ModelModule\Model\Users\Roles\UsersTodoCrudHandler',
    ),
);
