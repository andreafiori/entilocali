<?php

namespace Application;

return array(
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index'                                                  => 'Application\Controller\IndexController',
            'Application\Controller\AttachmentsSThreeDownloader'                            => 'Application\Controller\AttachmentsSThreeDownloaderController',
            'Application\Controller\PasswordPreview'                                        => 'Application\Controller\PasswordPreviewController',
            /* 'Application\Controller\Faq\Faq'                                             => 'Application\Controller\Faq\FaqController', */
            'Application\Controller\AlboPretorio\AlboPretorio'                              => 'Application\Controller\AlboPretorio\AlboPretorioController',
            'Application\Controller\AlboPretorio\AlboPretorioSearch'                        => 'Application\Controller\AlboPretorio\AlboPretorioSearchController',
            'Application\Controller\AlboPretorio\AlboPretorioExportSingle'                  => 'Application\Controller\AlboPretorio\AlboPretorioExportSingleController',
            'Application\Controller\AttiConcessione\AttiConcessione'                        => 'Application\Controller\AttiConcessione\AttiConcessioneController',
            'Application\Controller\AttiConcessione\AttiConcessioneSearch'                  => 'Application\Controller\AttiConcessione\AttiConcessioneSearchController',
            'Application\Controller\AttiConcessione\AttiConcessioneExportSingle'            => 'Application\Controller\AttiConcessione\AttiConcessioneExportSingleController',
            'Application\Controller\Contacts\Contacts'                                      => 'Application\Controller\Contacts\ContactsController',
            'Application\Controller\Contenuti\Contenuti'                                    => 'Application\Controller\Contenuti\ContenutiController',
            'Application\Controller\Contenuti\ContenutiSearch'                              => 'Application\Controller\Contenuti\ContenutiSearchController',
            'Application\Controller\Contenuti\ContenutiExport'                              => 'Application\Controller\Contenuti\ContenutiExportController',
            'Application\Controller\Contenuti\ContenutiExportSingle'                        => 'Application\Controller\Contenuti\ContenutiExportSingleController',
            'Application\Controller\StatoCivile\StatoCivile'                                => 'Application\Controller\StatoCivile\StatoCivileController',
            'Application\Controller\StatoCivile\StatoCivileSearch'                          => 'Application\Controller\StatoCivile\StatoCivileSearchController',
            'Application\Controller\StatoCivile\StatoCivileExport'                          => 'Application\Controller\StatoCivile\StatoCivileExportController',
            'Application\Controller\StatoCivile\StatoCivileExportSingle'                    => 'Application\Controller\StatoCivile\StatoCivileExportSingleController',
            'Application\Controller\AmministrazioneTrasparente\AmministrazioneTrasparente'  => 'Application\Controller\AmministrazioneTrasparente\AmministrazioneTrasparenteController',
            'Application\Controller\ContrattiPubblici\ContrattiPubblici'                    => 'Application\Controller\ContrattiPubblici\ContrattiPubbliciController',
            'Application\Controller\ContrattiPubblici\ContrattiPubbliciSearch'              => 'Application\Controller\ContrattiPubblici\ContrattiPubbliciSearchController',
            'Application\Controller\ContrattiPubblici\ContrattiPubbliciExportSingle'        => 'Application\Controller\ContrattiPubblici\ContrattiPubbliciExportSingleController',
            'Application\Controller\CssStyleSwitch'                                         => 'Application\Controller\CssStyleSwitchController',
            'Application\Controller\Users\UsersCreateAccount'                               => 'Application\Controller\Users\UsersCreateAccountController',
            'Application\Controller\Users\UsersRecoverPassword'                             => 'Application\Controller\Users\UsersRecoverPasswordController',
            'Application\Controller\Blogs\Blogs'                                            => 'Application\Controller\Blogs\BlogsController',
            'Application\Controller\Blogs\BlogsExport'                                      => 'Application\Controller\Blogs\BlogsExportController',
            'Application\Controller\Blogs\BlogsExportSingle'                                => 'Application\Controller\Blogs\BlogsExportSingleController',
            'Application\Controller\Posts\BlogsSearch'                                      => 'Application\Controller\Posts\BlogsSearchController',
            'Application\Controller\Photo\Photo'                                            => 'Application\Controller\Photo\PhotoController',
            'Application\Controller\Photo\PhotoSearch'                                      => 'Application\Controller\Photo\PhotoSearchController',
            'Application\Controller\CookieWarning'                                          => 'Application\Controller\CookieWarningController',
            'Application\Controller\SearchEngine\SearchEngine'                              => 'Application\Controller\SearchEngine\SearchEngineController',
            'Application\Controller\Autocertificazioni\Autocertificazioni'                  => 'Application\Controller\Autocertificazioni\AutocertificazioniController',
            'Application\Controller\Autocertificazioni\AutocertificazioniDemografico'       => 'Application\Controller\Autocertificazioni\AutocertificazioniDemograficoController',
            'Application\Controller\Autocertificazioni\AutocertificazioniPoliziaMunicipale' => 'Application\Controller\Autocertificazioni\AutocertificazioniPoliziaMunicipaleController',
            'Application\Controller\Autocertificazioni\AutocertificazioniServiziSociali'    => 'Application\Controller\Autocertificazioni\AutocertificazioniServiziSocialiController',
            'Application\Controller\Autocertificazioni\AutocertificazioniUfficioTecnico'    => 'Application\Controller\Autocertificazioni\AutocertificazioniUfficioTecnicoController',
        ),
    ),
    'router' => array(
                    'routes' => array(
                                    'main' => array(
                                        'type' => 'segment',
                                        'options' => array(
                                            'route' => '/[:lang[/]]',
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\Index',
                                                'action'     => 'index',
                                            ),
                                            'constraints' => array(
                                                'lang' => '[a-z]{2}',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                            'contenuti' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                    'route' => 'contenuti/articoli/dettagli/:subsectionid[/]',
                                                    'constraints' => array(
                                                        'subsectionid' => '[0-9]+',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Contenuti\Contenuti',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'contenuti-export' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'contenuti/export/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Contenuti\ContenutiExport',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'contenuti-export-single' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'common/:modulename/export/single/:action/:id[/]',
                                                    'constraints' => array(
                                                        'modulename'    => '(contenuti|amministrazione-trasparente)',
                                                        'action'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'id'            => '[0-9]+',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Contenuti\ContenutiExportSingle',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'contenuti-search' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'contenuti/form/ricerca/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Contenuti\ContenutiSearch',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'contatti' => array(
                                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'contatti/form/messaggio[/]',
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Contacts\Contacts',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'contatti-send' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'contatti/form/invio-messaggio/invio[/]',
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Contacts\Contacts',
                                                        'action'     => 'send',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            /* Blogs Posts */
                                            'blogs-categories' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                    'route' => 'blogs/:category[/][page/:page[/]][/order_by/:order_by][/:order[/]]',
                                                    'constraints' => array(
                                                        'category'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'page'        => '[0-9]+',
                                                        'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'order'       => 'ASC|DESC',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Blogs\Blogs',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'blogs-details' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                    'route' => 'blogs/:category/:title[/]',
                                                    'constraints' => array(
                                                        'category'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'title'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Blogs\Blogs',
                                                        'action'     => 'details',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'blogs-export-single' => array(
                                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route' => 'blogs/export/single/:action/:id[/]',
                                                    'constraints' => array(
                                                        'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'id'        => '[0-9]+',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Blogs\BlogsExportSingle',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'photo-gallery' => array(
                                                'type' => 'segment',
                                                'options' => array(
                                                    'route' => 'foto/galleria[/][pag/:page[/]][/order_by/:order_by][/:order[/]]',
                                                    'constraints' => array(
                                                        'page'        => '[0-9]+',
                                                        'order_by'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'order'       => 'ASC|DESC',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Photo\Photo',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            /*
                                            'photo-gallery-details' => array(
                                                'type' => 'segment',
                                                'options' => array(
                                                    'route' => '/photo/gallery/:category/:title[/]',
                                                    'constraints' => array(
                                                        'category'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'title'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Photo\Photo',
                                                        'action'     => 'details',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            */
                                            'blogs-search' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'posts/blogs/form/ricerca/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Posts\BlogsSearch',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'photo-search' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'posts/photo/form/ricerca/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Posts\PhotoSearch',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'search-engine' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                    'route' => 'motore/ricerca/risultati[/]',
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\SearchEngine\SearchEngine',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                        ),
                                    ),
                                    'notfound' => array(
                                                    'type' => 'segment',
                                                    'options' => array(
                                                        'route' => '/page/not/found/',
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'     => 'notfound',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                    ),
                                    'css-style-switch' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                                'route'    => '/css/styeleswitch/[:cssname[/]]',
                                                                'constraints' => array(
                                                                        'cssname'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                                ),
                                                                'defaults' => array(
                                                                        'controller' => 'Application\Controller\CssStyleSwitch',
                                                                        'action'     => 'index',
                                                                ),
                                                ),
                                                'may_terminate' => true,
                                    ),
                                    'attachments-sthree-download' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                    'route'    => '/attachments/download/single/:type/:id[/]',
                                                    'constraints' => array(
                                                        'type'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        'id'      => '[0-9]+',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\AttachmentsSThreeDownloader',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                    ),
                                    'password-preview' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                    'route'    => '/password/preview/form[/]',
                                                    'constraints' => array(

                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\PasswordPreview',
                                                        'action'     => 'index',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                    ),
                                    'password-preview-logout' => array(
                                                'type'    => 'segment',
                                                'options' => array(
                                                    'route'    => '/password/preview/logout[/]',
                                                    'constraints' => array(

                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\PasswordPreview',
                                                        'action'     => 'logout',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                    ),
                                    /*
                                    'document-export' => array(
                                                    'type'    => 'segment',
                                                    'options' => array(
                                                                    'route'       => '/document/[:subject][/][:filetype][/][:id[/]]',
                                                                    'constraints' => array(

                                                                    ),
                                                                    'defaults' => array(
                                                                        'controller' => 'Application\Controller\DocumentExport',
                                                                        'action'     => 'index',
                                                                    ),
                                                    ),
                                                    'may_terminate' => true,
                                    ),
                                    'faq' => array(
                                                'type'    => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                            'route'    => '/faq/domande[/][:action]',
                                                            'constraints' => array(

                                                            ),
                                                            'defaults' => array(
                                                                'controller'    => 'Application\Controller\Faq\Faq',
                                                                'action'        => 'index',
                                                            ),
                                                ),
                                                'may_terminate' => true,
                                    ),
                                    */
                                    'albo-pretorio' => array(
                                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                                        'options' => array(
                                                                'route'    => '/albo-pretorio/atti/elenco[/][page/:page[/]]',
                                                                'constraints' => array(
                                                                    'page' => '[0-9]+',
                                                                ),
                                                                'defaults' => array(
                                                                    'controller' => 'Application\Controller\AlboPretorio\AlboPretorio',
                                                                    'action'    => 'index',
                                                                ),
                                                        ),
                                                        'may_terminate' => true,
                                                        'child_routes' => array(
                                                                'default' => array(
                                                                    'type'    => 'Wildcard',
                                                                    'options' => array(),
                                                                ),
                                                        ),
                                    ),
                                    'albo-pretorio-details' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/albo-pretorio/atti/dettagli/:id',
                                            'constraints' => array(
                                                'id' => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller'    => 'Application\Controller\AlboPretorio\AlboPretorio',
                                                'action'        => 'details',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'albo-pretorio-search' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/albo-pretorio/atti/form/:action[/]',
                                            'constraints' => array(
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            ),
                                            'defaults' => array(
                                                'controller'    => 'Application\Controller\AlboPretorio\AlboPretorioSearch',
                                                'action'        => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'albo-pretorio-export' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/albo-pretorio/export/multi/:action[/]',
                                            'constraints' => array(
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\AlboPretorio\AlboPretorioExport',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'albo-pretorio-export-single' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/albo-pretorio/export/single/:action/:id[/]',
                                            'constraints' => array(
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'        => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\AlboPretorio\AlboPretorioExportSingle',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'stato-civile' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/stato-civile/pubblicazioni/elenco[/][page/:page[/]]',
                                                        'constraints' => array(
                                                            'page' => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\StatoCivile\StatoCivile',
                                                            'action'     => 'index',
                                                        ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                                    'default' => array(
                                                        'type'    => 'Wildcard',
                                                        'options' => array( ),
                                                    ),
                                        ),
                                    ),
                                    'stato-civile-details' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/stato-civile/atti/dettagli/:id[/]',
                                            'constraints' => array(
                                                'id' => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\StatoCivile\StatoCivile',
                                                'action'     => 'details'
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'stato-civile-search' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/stato-civile/atti/form/ricerca/:action[/]',
                                            'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\StatoCivile\StatoCivileSearch',
                                                'action' => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'stato-civile-export' => array(
                                                    'type'    => 'Zend\Mvc\Router\Http\Segment',
                                                    'options' => array(
                                                        'route'    => '/stato-civile/export/:action[/]',
                                                        'constraints' => array(
                                                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\StatoCivile\StatoCivileExport',
                                                            'action'     => 'index',
                                                        ),
                                                    ),
                                                    'may_terminate' => true,
                                    ),
                                    'stato-civile-export-single' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/stato-civile/export/single/:action/:id[/]',
                                            'constraints' => array(
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'        => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\StatoCivile\StatoCivileExportSingle',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'amministrazione-trasparente' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/amministrazione-trasparente/articoli/elenco/:profondita[/]',
                                                        'constraints' => array(
                                                            'profondita'  => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\AmministrazioneTrasparente\AmministrazioneTrasparente',
                                                            'action'     => 'index',
                                                        ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                                        'default' => array(
                                                                'type'    => 'Wildcard',
                                                                'options' => array(
                                                            ),
                                                        ),
                                        ),
                                    ),
                                    'amministrazione-trasparente-export-single' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/amministrazione-trasparente/export/single/:action/:id[/]',
                                            'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'     => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\AmministrazioneTrasparente\AmministrazioneTrasparenteExportSingle',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'atti-concessione' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/atti-concessione/atti/elenco[/][page/:page[/]]',
                                                        'constraints' => array(
                                                            'page'      => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\AttiConcessione\AttiConcessione',
                                                            'action'     => 'index',
                                                        ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                                        'default' => array(
                                                                        'type'    => 'Wildcard',
                                                                        'options' => array(
                                                                    ),
                                                        ),
                                        ),
                                    ),
                                    'atti-concessione-details' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/atti-concessione/atti/dettagli/:id[/]',
                                            'constraints' => array(
                                                'id' => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\AttiConcessione\AttiConcessione',
                                                'action'     => 'details',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'atti-concessione-search' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route' => '/atti-concessione/atti/form/ricerca/:action[/]',
                                            'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\AttiConcessione\AttiConcessioneSearch',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'atti-concessione-export-single' => array(
                                        'type' => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/atti-concessione/export/single/:action/:id[/]',
                                            'constraints' => array(
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'        => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\AttiConcessione\AttiConcessioneExportSingle',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'contratti-pubblici' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/contratti-pubblici/bandi-e-contratti/elenco[/][page/:page[/]]',
                                                        'constraints' => array(
                                                            'page'  => '[0-9]+',
                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\ContrattiPubblici\ContrattiPubblici',
                                                            'action'    => 'index',
                                                        ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'contratti-pubblici-details' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/contratti-pubblici/bandi-e-contratti/dettagli/:id[/]',
                                            'constraints' => array(
                                                'id' => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\ContrattiPubblici\ContrattiPubblici',
                                                'action'     => 'details',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'contratti-pubblici-search' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/contratti-pubblici/bandi-e-contratti/form/ricerca/:action',
                                            'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\ContrattiPubblici\ContrattiPubbliciSearch',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'contratti-pubblici-export' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/contratti-pubblici/bandi-e-contratti/export/:format/:id[/]',
                                            'constraints' => array(
                                                'id' => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\ContrattiPubblici\ContrattiPubblici',
                                                'action'    => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'contratti-pubblici-export-single' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/contratti-pubblici/export/single/:action/:id[/]',
                                            'constraints' => array(
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'        => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\ContrattiPubblici\ContrattiPubbliciExportSingle',
                                                'action'     => 'index',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'newsletter' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/newsletter[/]',
                                                        'constraints' => array(

                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Index',
                                                            'action'    => 'index',
                                                        ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                                        'default' => array(
                                                            'type' => 'Wildcard',
                                                            'options' => array(

                                                            ),
                                                        ),
                                        ),
                                    ),
                                    'recupero-password' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/account/recupero-password[/]',
                                                        'constraints' => array(

                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Users\UsersRecoverPassword',
                                                            'action'     => 'index',
                                                        ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                                        'default' => array(
                                                            'type'    => 'Wildcard',
                                                            'options' => array(

                                                            ),
                                                        ),
                                        ),
                                    ),
                                    'registrazione' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                                        'route'    => '/registrazione/crea-account[/]',
                                                        'constraints' => array(

                                                        ),
                                                        'defaults' => array(
                                                            'controller' => 'Application\Controller\Users\UsersCreateAccount',
                                                            'action'    => 'index',
                                                        ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                                        'default' => array(
                                                                'type'    => 'Wildcard',
                                                                'options' => array(
                                                            ),
                                                        ),
                                        ),
                                    ),
                                    'registrazione-invio' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/registrazione/crea-account/invio[/]',
                                            'constraints' => array(

                                            ),
                                            'defaults' => array(
                                                'controller'    => 'Application\Controller\Users\UsersCreateAccount',
                                                'action'        => 'register',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                            'default' => array(
                                                'type'    => 'Wildcard',
                                                'options' => array(

                                                ),
                                            ),
                                        ),
                                    ),
                                    'registrazione-conferma' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/registrazione/crea-account/conferma/attivazione[/]',
                                            'constraints' => array(

                                            ),
                                            'defaults' => array(
                                                'controller'    => 'Application\Controller\Users\UsersCreateAccount',
                                                'action'        => 'confirm',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                            'default' => array(
                                                'type'    => 'Wildcard',
                                                'options' => array(
                                                ),
                                            ),
                                        ),
                                    ),
                                    'cookie-warning-confirm' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/cookie/warning/confirm[/]',
                                            'constraints' => array(

                                            ),
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\CookieWarning',
                                                'action'    => 'confirm',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                            'default' => array(
                                                'type'    => 'Wildcard',
                                                'options' => array(

                                                ),
                                            ),
                                        ),
                                    ),
                                    'cookie-warning-deny' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route'    => '/cookie/warning/deny[/]',
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\CookieWarning',
                                                'action'    => 'deny',
                                            ),
                                        ),
                                        'may_terminate' => true,
                                    ),
                                    'autocertificazioni' => array(
                                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => array(
                                            'route' => '/moduli/autocertificazioni[/]',
                                            'defaults' => array(
                                                'controller' => 'Application\Controller\Autocertificazioni\Autocertificazioni',
                                                'action' => 'index'
                                            ),
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                            'demografico' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'demografici/elenco[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\Autocertificazioni',
                                                        'action'     => 'demografico',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'demografico-form' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route' => 'demografici/forms/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\AutocertificazioniDemografico',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'poliziamunicipale' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route'    => 'polizia/municipale/elenco[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\Autocertificazioni',
                                                        'action'     => 'poliziamunicipale',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'poliziamunicipale-form' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route' => 'polizia/municipale/forms/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\AutocertificazioniPoliziaMunicipale',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'servizisociali' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route' => 'servizi/sociali/elenco[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\Autocertificazioni',
                                                        'action'     => 'servizisociali',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'servizisociali-form' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route' => 'servizi/sociali/forms/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\AutocertificazioniServiziSocialiController',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'ufficiotecnico' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route' => 'ufficio/tecnico/elenco[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\Autocertificazioni',
                                                        'action'     => 'ufficiotecnico',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                            'ufficiotecnico-form' => array(
                                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                                'options' => array(
                                                    'route' => 'ufficio/tecnico/forms/:action[/]',
                                                    'constraints' => array(
                                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                    ),
                                                    'defaults' => array(
                                                        'controller' => 'Application\Controller\Autocertificazioni\AutocertificazioniUfficioTecnico',
                                                    ),
                                                ),
                                                'may_terminate' => true,
                                            ),
                                        ),
                                    ),
                    ),
    ),
    'service_manager' => array(
                    'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
                    'abstract_factories' => array(
                               'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
                               'Zend\Log\LoggerAbstractServiceFactory',
                    ),
                    'factories' => array(
                        'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
                    ),
    ),
    'translator' => array(
        'locale' => 'it_IT',
        'translation_file_patterns' => array(
            array(
                'type'          => 'gettext',
                'base_dir'      => __DIR__ . '/../language',
                'pattern'       => '%s.mo',
                'text_domain'   => __NAMESPACE__,
            ),
        ),
    ),
    'view_manager' => array(
                    'display_not_found_reason' => true,
                    'display_exceptions'       => true,
                    'doctype'                  => 'HTML5',
                    'not_found_template'       => 'error/404',
                    'exception_template'       => 'error/index',
                    'template_map' => array(
                        'application/home-page/index'                           => __DIR__ . '/../view/empty.phtml',
                        'application/index/index'                               => __DIR__ . '/../view/application/index/index.phtml',
                        'application/pagination'                                => __DIR__ . '/../view/application/pagination/numbers.phtml',
                        'application/index/notfound'                            => __DIR__ . '/../view/empty.phtml',
                        'application/contacts/index'                            => __DIR__ . '/../view/empty.phtml',
                        'application/contacts/send'                             => __DIR__ . '/../view/empty.phtml',
                        'layout/layout'                                         => __DIR__ . '/../view/layout/layout.phtml',
                        'application/feed/index'                                => __DIR__ . '/../view/application/index/index.phtml',
                        'application/amministrazione-trasparente/index'         => __DIR__ . '/../view/empty.phtml',
                        'application/amministrazione-trasparente-search/index'  => __DIR__ . '/../view/empty.phtml',
                        'application/contratti-pubblici/index'                  => __DIR__ . '/../view/empty.phtml',
                        'application/contratti-pubblici/details'                => __DIR__ . '/../view/empty.phtml',
                        'application/contratti-pubblici-search/index'           => __DIR__ . '/../view/empty.phtml',
                        'application/albo-pretorio/index'                       => __DIR__ . '/../view/empty.phtml',
                        'application/albo-pretorio-search/index'                => __DIR__ . '/../view/empty.phtml',
                        'application/albo-pretorio/details'                     => __DIR__ . '/../view/empty.phtml',
                        'application/stato-civile/index'                        => __DIR__ . '/../view/empty.phtml',
                        'application/stato-civile-search/index'                 => __DIR__ . '/../view/empty.phtml',
                        'application/stato-civile/details'                      => __DIR__ . '/../view/empty.phtml',
                        'application/stato-civile-export-single/csv'            => __DIR__ . '/../view/empty.phtml',
                        'application/stato-civile-export-single/txt'            => __DIR__ . '/../view/empty.phtml',
                        'application/stato-civile-export-single/pdf'            => __DIR__ . '/../view/empty.phtml',
                        'application/stato-civile-export-single/json'           => __DIR__ . '/../view/empty.phtml',
                        'application/atti-concessione/index'                    => __DIR__ . '/../view/empty.phtml',
                        'application/atti-concessione-search/index'             => __DIR__ . '/../view/empty.phtml',
                        'application/atti-concessione/details'                  => __DIR__ . '/../view/empty.phtml',
                        'application/atti-concessione-export-single/index'      => __DIR__ . '/../view/empty.phtml',
                        'application/contenuti/index'                           => __DIR__ . '/../view/empty.phtml',
                        'application/contenuti-export/csv'                      => __DIR__ . '/../view/empty.phtml',
                        'application/contenuti-export/pdf'                      => __DIR__ . '/../view/empty.phtml',
                        'application/contenuti-export/txt'                      => __DIR__ . '/../view/empty.phtml',
                        'application/blogs/index'                               => __DIR__ . '/../view/empty.phtml',
                        'application/photo/index'                               => __DIR__ . '/../view/empty.phtml',
                        'application/blogs/details'                             => __DIR__ . '/../view/empty.phtml',
                        'application/css-style-switch/index'                    => __DIR__ . '/../view/empty.phtml',
                        'application/users-create-account/index'                => __DIR__ . '/../view/empty.phtml',
                        'application/users-recover-password/index'              => __DIR__ . '/../view/empty.phtml',
                        'application/cookie-warning/confirm'                    => __DIR__ . '/../view/empty.phtml',
                        'application/password-preview/index'                    => __DIR__ . '/../view/empty.phtml',
                        'application/search-engine/index'                       => __DIR__ . '/../view/empty.phtml',
                        'application/autocertificazioni/index'                  => __DIR__ . '/../view/empty.phtml',
                        'application/autocertificazioni/demografico'            => __DIR__ . '/../view/empty.phtml',
                        'application/autocertificazioni/poliziamunicipale'      => __DIR__ . '/../view/empty.phtml',
                        'application/autocertificazioni/servizisociali'         => __DIR__ . '/../view/empty.phtml',
                        'application/autocertificazioni/ufficiotecnico'         => __DIR__ . '/../view/empty.phtml',
                        'error/404'                                             => __DIR__ . '/../view/error/notfound.phtml',
                        'error/index'                                           => __DIR__ . '/../view/error/index.phtml',
                        'error/dbconnection'                                    => __DIR__ . '/../view/error/dbconnection.phtml',
                    ),
                    'template_path_stack' => array(
                                    __DIR__ . '/../view',
                                    __DIR__ . '/../../../public',
                                    __DIR__ . '/../../../../public'
                    ),
                    'strategies' => array(
                        'ViewJsonStrategy',
                        'ViewFeedStrategy',
                    ),
    ),
    // Placeholder for console routes
    'console' => array(
                'router' => array(
                        'routes' => array(),
                ),
    ),
    // Doctrine
    'doctrine' => array(
                'eventmanager' => array(
                    'orm_default' => array(
                        'subscribers' => array(
                            'Gedmo\Tree\TreeListener',
                            'Gedmo\Timestampable\TimestampableListener',
                            'Gedmo\Sluggable\SluggableListener',
                            'Gedmo\Loggable\LoggableListener',
                            'Gedmo\Sortable\SortableListener'
                        ),
                    ),
                ),
                'driver' => array(
                                'Application_driver' => array(
                                                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                                'cache' => 'array',
                                                'paths' => array(__DIR__ . '/../src/Application/Entity')
                                ),
                                'orm_default' => array(
                                                'drivers' => array(
                                                    'Application\Entity' =>  'Application_driver'
                                                ),
                                ),
                ),
                'fixture' => array(
                    __NAMESPACE__.'_fixture' => __DIR__ . '/../src/'.__NAMESPACE__.'/Fixture',
                )
    ),
);
