<?php

namespace Admin\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiFormSearch;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Languages\LanguagesFormSearch;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use Zend\Session\Container as SessionContainer;

class ContenutiSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $page                   = $this->params()->fromRoute('page');
        $configurations         = $this->layout()->getVariable('configurations');
        $userDetails            = $this->layout()->getVariable('userDetails');
        $userRole               = isset($userDetails->role) ? $userDetails->role : '';
        $userId                 = isset($userDetails->id) ? $userDetails->id : 1;
        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');
        $ammTraspSottoSezioneId = $this->layout()->getVariable('amministrazione_trasparente_sottosezione_id');
        $languageSelection      = $this->params()->fromRoute('languageSelection');

        $sessionContainer       = new SessionContainer();

        $helper = new ContenutiControllerHelper();

        try {
            $helper->setContenutiGetterWrapper(new ContenutiGetterWrapper(new ContenutiGetter($em)));

            $wrapper = $helper->recoverWrapper( $helper->getContenutiGetterWrapper(), array(
                'excludeSottosezioneId' => isset($configurations['amministrazione_trasparente_sottosezione_id']) ? $configurations['amministrazione_trasparente_sottosezione_id'] : null,
                'excludeSezioneId'      => isset($configurations['amministrazione_trasparente_sezione_id']) ? $configurations['amministrazione_trasparente_sezione_id'] : null,
                'showToAll'             => ($userRole=='WebMaster') ? null : 1,
                'utente'                => ($userRole=='WebMaster') ? null : $userId,
                'languageAbbreviation'  => $languageSelection,
                'orderBy'               => 'contenuti.id DESC',
            ));
            $wrapper->setupPaginator( $wrapper->setupQuery($em) );
            $wrapper->setupPaginatorCurrentPage( isset($page) ? $page : null );
            $wrapper->setupPaginatorItemsPerPage(null);
            $wrapper->setEntityManager($em);

            $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));
            $helper->setupSottoSezioniGetterWrapperRecords(array(
                'excludeId'             => $ammTraspSottoSezioneId,
                'excludeSezioneId'      => $ammTraspSezioneId,
                'showToAll'             => ($userRole == 'WebMaster') ? null : 1,
                'languageAbbreviation'  => $languageSelection,
            ));
            $helper->formatSottoSezioniGetterWrapperRecordsForDropdown();

            $paginatorRecords = $wrapper->addAttachmentsToPaginatorRecords(
                $wrapper->setupRecords(),
                array()
            );

            $isMultiLanguage = !empty($configurations['isMultiLanguage']);
            if ($isMultiLanguage==1) {
                $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($em)));

                $formLanguage = $helper->setupLanguageFormSearch(
                    new LanguagesFormSearch(),
                    array('status' => 1),
                    $languageSelection
                );
            }

            $formSearch = new ContenutiFormSearch();
            $formSearch->addSottosezioni( $helper->getSottoSezioniGetterWrapperRecords() );
            $formSearch->addInHome();
            $formSearch->addSubmitButton();
            $formSearch->setData(array(
                array('languageSelection' => $languageSelection),
                array() // TODO: session post form here...
            ));

            $paginator = $wrapper->getPaginator();

            $paginatorRecordsCount = $paginator->getTotalItemCount();

            $paginatorRecords = $this->formatRecordsToShowOnTable($paginatorRecords);

            $this->layout()->setVariables(array(
                'tableTitle'            => 'Contenuti',
                'tableDescription'      => $paginatorRecordsCount.' contenuti in archivio',
                'paginator'             => $paginator,
                'records'               => $paginatorRecords,
                'templatePartial'       => 'datatable/datatable_contenuti.phtml',
                'formSearch'            => $formSearch,
                'formLanguage'          => isset($formLanguage) ? $formLanguage : null,
                'columns' => array(
                    "Titolo",
                    "Sezione",
                    "Sotto sezione",
                    'Data inserimento',
                    'Data scadenza',
                    'Inserito da',
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                ),
            ));

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                'messageType'       => 'warning',
                'messageTitle'      => 'Errore verificato',
                'messageText'       => $e->getMessage(),
                'templatePartial'   => 'message.phtml'
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array|null $records
     * @return array
     */
    private function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                if ($row['attivo']==1) {
                    $enableDisableLink = $this->url()->fromRoute('admin/contenuti-enabledisable', array(
                            'lang'              => $this->params()->fromRoute('lang'),
                            'languageSelection' => $this->params()->fromRoute('languageSelection'),
                            'id'                => $row['id'],
                            'action'            => 'disable',
                        )
                    );
                } else {
                    $enableDisableLink = $this->url()->fromRoute('admin/contenuti-enabledisable', array(
                            'lang'              => $this->params()->fromRoute('lang'),
                            'languageSelection' => $this->params()->fromRoute('languageSelection'),
                            'id'                => $row['id'],
                            'action'            => 'enable',
                        )
                    );
                }

                /* Home page put \ remove link */
                if ($row['home']==1) {
                    $homePutRemoveLink = $this->url()->fromRoute('admin/contenuti-homeputremove', array(
                            'lang'          => $this->params()->fromRoute('lang'),
                            'action'        => 'remove',
                            'id'            => $row['id']
                        )
                    );
                } else {
                    $homePutRemoveLink = $this->url()->fromRoute('admin/contenuti-homeputremove', array(
                            'lang'          => $this->params()->fromRoute('lang'),
                            'action'        => 'put',
                            'id'            => $row['id']
                        )
                    );
                }

                $arrayToReturn[] = array(
                    $row['titolo'],
                    $row['nomeSezione'],
                    $row['nomeSottosezione'],
                    $row['dataInserimento'],
                    $row['dataScadenza'],
                    $row['name'].' '.$row['surname'],
                    /* Enable \ Disable button */
                    array(
                        'type'      => $row['attivo']==1 ? 'activeButton' : 'disableButton',
                        'href'      => $enableDisableLink,
                        'value'     => $row['attivo'],
                        'title'     => $row['attivo']==1 ? 'Nascondi contenuto sul sito' : 'Mostra contenuto sul sito',
                    ),
                    /* Edit button */
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/contenuti-form', array(
                                'lang'              => $this->params()->fromRoute('lang'),
                                'module'            => 'contenuti',
                                'id'                => $row['id'],
                                'languageSelection' => $this->params()->fromRoute('languageSelection'),
                                'previouspage'      => $this->params()->fromRoute('page'),
                            )
                        ),
                        'title' => 'Modifica contenuto'
                    ),
                    /* Delete button */
                    array(
                        'type' => 'deleteButton',
                        'href' => $this->url()->fromRoute('admin/contenuti-operations', array(
                                'lang'          => $this->params()->fromRoute('lang'),
                                'action'        => 'delete',
                                'id'            => $row['id']
                            )
                        ),
                        'data-id' => $row['id'],
                        'title'   => 'Elimina contenuto'
                    ),
                    /* Homepage button */
                    array(
                        'type'      => $row['home']==1 ? 'homepagePutButton' : 'homepageDelButton',
                        'href'      => $homePutRemoveLink,
                        'value'     => $row['home']==1 ? 'homepagePutButton' : 'homepageDelButton',
                    ),
                    /* Attachment button */
                    array(
                        'type' => 'attachButton',
                        'href' => $this->url()->fromRoute('admin/attachments-summary', array(
                                'lang'              => $this->params()->fromRoute('lang'),
                                'module'            => 'contenuti',
                                'referenceId'       => $row['id'],
                            )
                        ),
                        'attachmentsFilesCount' => isset($row['attachments']) ? count($row['attachments']) : 0,
                    )
                );

            }
        }

        return $arrayToReturn;
    }
}