<?php

namespace Admin\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiControllerHelper;
use Admin\Model\Contenuti\ContenutiFormSearch;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class ContenutiSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page           = $this->params()->fromRoute('page');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations = $this->layout()->getVariable('configurations');
        $userDetails    = $this->layout()->getVariable('userDetails');
        $userRole       = isset($userDetails->role) ? $userDetails->role : '';
        $userId         = isset($userDetails->id) ? $userDetails->id : 1;
        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');
        $ammTraspSottoSezioneId = $this->layout()->getVariable('amministrazione_trasparente_sottosezione_id');

        $helper = new ContenutiControllerHelper();
        $helper->setContenutiGetterWrapper( new ContenutiGetterWrapper(new ContenutiGetter($em)) );
        $wrapper = $helper->recoverWrapper( $helper->getContenutiGetterWrapper(), array(
            'orderBy'               => 'contenuti.id DESC',
            'excludeSottosezioneId' => isset($configurations['amministrazione_trasparente_sottosezione_id']) ? $configurations['amministrazione_trasparente_sottosezione_id'] : null,
            'excludeSezioneId'      => isset($configurations['amministrazione_trasparente_sezione_id']) ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'showToAll'             => ($userRole=='WebMaster') ? null : 1,
            'utente'                => ($userRole=='WebMaster') ? null : $userId
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
        ));
        $helper->formatSottoSezioniGetterWrapperRecordsForDropdown();

        $paginatorRecords = $wrapper->addAttachmentsToPaginatorRecords(
            $wrapper->setupRecords(),
            array()
        );

        $formSearch = new ContenutiFormSearch();
        $formSearch->addLingua(array(
            'it' => 'Italiano',
            'en' => 'Inglese',
        ));
        $formSearch->addSottosezioni( $helper->getSottoSezioniGetterWrapperRecords() );
        $formSearch->addInHome();
        $formSearch->addSubmitButton();

        $paginator = $wrapper->getPaginator();

        $paginatorRecordsCount = $paginator->getTotalItemCount();

        $paginatorRecords = $this->formatRecordsToShowOnTable($paginatorRecords);

        $this->layout()->setVariables(array(
            'tableTitle'            => 'Contenuti',
            'tableDescription'      => $paginatorRecordsCount.' contenuti in archivio',
            'paginator'             => $paginator,
            'total_item_count'      => $paginatorRecordsCount,
            'records'               => $paginatorRecords,
            'templatePartial'       => 'datatable/datatable_contenuti.phtml',
            'formSearch'            => $formSearch,
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
                            'lang'          => 'it',
                            'action'        => 'disable',
                            'id'            => $row['id']
                        )
                    );
                } else {
                    $enableDisableLink = $this->url()->fromRoute('admin/contenuti-enabledisable', array(
                            'lang'          => 'it',
                            'action'        => 'enable',
                            'id'            => $row['id']
                        )
                    );
                }

                /* Home page put \ remove link */
                if ($row['home']==1) {
                    $homePutRemoveLink = $this->url()->fromRoute('admin/contenuti-homeputremove', array(
                            'lang'          => 'it',
                            'action'        => 'remove',
                            'id'            => $row['id']
                        )
                    );
                } else {
                    $homePutRemoveLink = $this->url()->fromRoute('admin/contenuti-homeputremove', array(
                            'lang'          => 'it',
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
                                'lang'      => 'it',
                                'module'    => 'contenuti',
                                'id'        => $row['id']
                            )
                        ),
                        'title' => 'Modifica contenuto'
                    ),
                    /* Delete button */
                    array(
                        'type'      => 'deleteButton',
                        'href'      => $this->url()->fromRoute('admin/contenuti-operations', array(
                                'lang'          => 'it',
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
                                'lang'          => 'it',
                                'module'        => 'contenuti',
                                'referenceId'   => $row['id'],
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