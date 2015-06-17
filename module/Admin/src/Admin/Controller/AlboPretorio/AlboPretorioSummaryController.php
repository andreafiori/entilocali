<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioFormSearch;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Modules\ModulesContainer;

class AlboPretorioSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');
        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new AlboPretorioControllerHelper();

        try {
            $sezioniRecords = $helper->recoverWrapperRecords(
                new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em)),
                array('orderBy' => 'aps.nome ASC')
            );
            $helper->checkRecords($sezioniRecords, 'Nessuna sezione presente');
            $alboArticoliWrapper = $helper->recoverWrapperRecordsPaginator(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                array('orderBy' => 'alboArticoli.id DESC'),
                $page,
                $perPage
            );

            $formSearch = new AlboPretorioFormSearch();
            $formSearch->addYears();
            $formSearch->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') );
            $formSearch->addCheckExpired();
            $formSearch->addSubmitButton();
            $formSearch->addResetButton();
            $formSearch->addCsrf();

            $alboArticoliRecords = $alboArticoliWrapper->setupRecords();

            $alboArticoliWrapper->setEntityManager($em);
            $alboArticoliWrapper->addAttachmentsFromRecords(
                $alboArticoliRecords,
                array(
                    'moduleId' => ModulesContainer::albo_pretorio_id,
                )
            );

            $paginator = $alboArticoliWrapper->getPaginator();

            $this->layout()->setVariables(array(
                    'formSearch'        => $formSearch,
                    'tableTitle'        => 'Albo pretorio',
                    'tableDescription'  => $paginator->getTotalItemCount()." atti in archivio",
                    'columns' => array(
                        array('label' => 'Num \ Anno', 'width' => '10%'),
                        array('label' => 'Titolo', 'width' => '20%'),
                        'Settore',
                        'Scadenza',
                        'Data attivazione',
                        'Inserito da',
                        '&nbsp;',
                        '&nbsp;',
                        '&nbsp;',
                        '&nbsp;',
                        '&nbsp;',
                        '&nbsp;',
                    ),
                    'paginator'         => $paginator,
                    'records'           => $this->formatArticoliRecords($alboArticoliRecords),
                    'templatePartial'   => 'datatable/datatable_albo_pretorio.phtml'
                )
            );

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                    'messageType'       => 'warning',
                    'messageTitle'      => 'Errore verificato',
                    'messageText'       => $e->getMessage(),
                    'templatePartial'   => 'message.phtml'
                )
            );
        }

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array $records
         * @return array|null
         */
        protected function formatArticoliRecords($records, $modulePrefixLink = 'albo-pretorio')
        {
            $lang = $this->params()->fromRoute('lang');

            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $record) {

                    $rowClass = '';
                    if ($record['attivo']==0 and $record['annullato']==1) {
                        $rowClass = 'rowHidden';
                    }

                    if ($record['attivo']==1 and $record['pubblicare']==0 and $record['annullato']==0) {
                        $rowClass = 'rowNew';
                    }

                    $arrayLine = array(
                        array(
                            'type'   => 'field',
                            'record' => $record['numeroAtto']." / ".$record['anno'],
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => $record['titolo'],
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => $record['nomeSezione'],
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => $record['dataScadenza'],
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => ($record['pubblicare']==1) ? $record['dataAttivazione'] : 'Non ancora pubblicato',
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => $record['userName'].' '.$record['userSurname'],
                            'class'  => $rowClass,
                        ),
                    );

                    /* Attachment button */
                    $arrayLine[] = array(
                        'type'  => 'attachButton',
                        'href'  => $this->url()->fromRoute('admin/attachments-summary', array(
                            'lang'          => $lang,
                            'module'        => $modulePrefixLink,
                            'referenceId'   => $record['id'],
                        )),
                        'attachmentsFilesCount' => isset($record['attachments']) ? count($record['attachments']) : 0,
                    );

                    /* Homepage button */
                    $arrayLine[] = array(
                        'type'      => $record['home']==1 ? 'homepagePutButton' : 'homepageDelButton',
                        'href'      => '#',
                        'value'     => $record['home']==1 ? 1 : 0,
                    );

                    if ($record['annullato']) {
                        $arrayLine[] = array(
                            'type'  => 'alboAnnulledButton',
                            'class' => $rowClass,
                        );
                    } else {
                        if ($record['pubblicare']==1) {

                            /* Rettifica button */
                            $arrayLine[] = array(
                                'type'      => 'alboRettificaButton',
                                'data-form-action' => $this->url()->fromRoute('admin/albo-pretorio-form-rettifica', array(
                                    'lang'      => $lang,
                                    'id'        => $record['id'],
                                )),
                                'title'     => 'Rettifica articolo',
                                'data-id'   => $record['id'],
                            );

                        } else {
                            /* Publish button */
                            $arrayLine[] = array(
                                'type'      => 'alboPublishButton',
                                'data-form-action' => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                    'lang'          => $lang,
                                    'action'        => 'publish'
                                )),
                                'data-id'   => $record['id'],
                                'title'     => 'Pubblica articolo',
                            );
                            /* Update button */
                            $arrayLine[] = array(
                                'type'      => 'updateButton',
                                'href'      => $this->url()->fromRoute('admin/albo-pretorio-form', array(
                                    'lang'  => $lang,
                                    'id'    => $record['id']
                                )),
                                'title'     => 'Modifica articolo',
                            );
                        }
                        /* Relata PDF button */
                        $arrayLine[] = array(
                            'type'   => 'relatapdfButton',
                            'href'   => $this->url()->fromRoute('admin/albo-pretorio-relata-pdf', array(
                                'lang'      => 'it',
                                'module'    => $modulePrefixLink,
                                'id'        => $record['id'],
                            )),
                        );
                        /* Invio enti terzi button */
                        $arrayLine[] = array(
                            'type'   => 'enteterzoButton',
                            'href'   => $this->url()->fromRoute('admin/invio-ente-terzo', array(
                                'lang'          => $lang,
                                'module'        => $modulePrefixLink,
                                'id'            => $record['id'],
                            )),
                        );
                        /* Annull button if published */
                        if ($record['pubblicare']==1) {
                            $arrayLine[] = array(
                                'type'      => 'alboAnnullButton',
                                'data-form-action' => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                    'lang'          => $lang,
                                    'action'        => 'annull'
                                )),
                                'href'      => '#',
                                'data-id'   => $record['id'],
                                'title'     => 'Annulla articolo',
                            );
                        }
                    }

                    $arrayToReturn[] = $arrayLine;
                }
            }

            return $arrayToReturn;
        }
}