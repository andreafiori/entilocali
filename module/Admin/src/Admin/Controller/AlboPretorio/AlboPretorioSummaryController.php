<?php

namespace Admin\Controller\AlboPretorio;

use Application\Controller\AlboPretorio\AlboPretorioSearchController;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioFormSearch;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Modules\ModulesContainer;
use Zend\Session\Container as SessionContainer;

/**
 * Albo Pretorio Atti index
 */
class AlboPretorioSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new AlboPretorioControllerHelper();

        $sessionContainer = new SessionContainer();
        $sessionSearch = $sessionContainer->offsetGet(AlboPretorioSearchController::sessionIdentifier);

        try {
            $arraySearch = $helper->recoverArrayQuerySearch($sessionSearch);
            $sezioniRecords = $helper->recoverWrapperRecords(
                new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em)),
                array('orderBy' => 'aps.nome ASC')
            );
            $helper->checkRecords($sezioniRecords, 'Nessuna sezione presente');
            $alboArticoliWrapper = $helper->recoverWrapperRecordsPaginator(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                $arraySearch,
                $page,
                $perPage
            );

            $formSearch = new AlboPretorioFormSearch();
            $formSearch->addYears();
            $formSearch->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') );
            $formSearch->addCheckExpired();
            $formSearch->addSubmitButton();
            $formSearch->addResetButton();
            $formSearch->addHomePage();

            if (!empty($sessionSearch)) {
                $formSearch->setData(array(
                    'numero_progressivo'    => $sessionSearch['numero_progressivo'],
                    'numero_atto'           => $sessionSearch['numero_atto'],
                    'mese'                  => $sessionSearch['mese'],
                    'anno'                  => $sessionSearch['anno'],
                    'sezione'               => $sessionSearch['sezione'],
                    'testo'                 => $sessionSearch['testo'],
                    'home'                  => $sessionSearch['home'],
                    'expired'               => $sessionSearch['expired'],
                ));
            }

            $alboArticoliRecords = $alboArticoliWrapper->setupRecords();

            $alboArticoliWrapper->setEntityManager($em);
            $alboArticoliWrapper->addAttachmentsFromRecords(
                $alboArticoliRecords,
                array('moduleId' => ModulesContainer::albo_pretorio_id)
            );

            $paginator = $alboArticoliWrapper->getPaginator();
            $paginatorCount = $paginator->getTotalItemCount();

            $tableDescription = $paginatorCount." atti in archivio. ";

            if ($paginatorCount > 0) {

                $alboStatisticsRecords = $helper->recoverWrapperRecords(
                    new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                    array_merge($arraySearch, array(
                        'fields'=> '
                            (SELECT COUNT(alboArt.id) FROM Application\Entity\ZfcmsComuniAlboArticoli alboArt WHERE alboArt.attivo = 0) AS disattivati,
                            (SELECT COUNT(aArt.id) FROM Application\Entity\ZfcmsComuniAlboArticoli aArt WHERE aArt.annullato = 1) AS annullati,
                            (SELECT COUNT(aa.id) FROM Application\Entity\ZfcmsComuniAlboArticoli aa WHERE aa.pubblicare = 0) AS nonPubblicati,
                            (SELECT COUNT(aHome.id) FROM Application\Entity\ZfcmsComuniAlboArticoli aHome WHERE aHome.pubblicare = 0) AS inHome
                        ',
                        'limit' => 1
                    ))
                );

                $tableDescription .= $alboStatisticsRecords[0]['disattivati'].' disattivati';
                $tableDescription .= ', '.$alboStatisticsRecords[0]['annullati'].' annullati';
                $tableDescription .= ', '.$alboStatisticsRecords[0]['nonPubblicati'].' non pubblicati';
                $tableDescription .= ', '.$alboStatisticsRecords[0]['inHome'].' presenti in home page';
            }

            $this->layout()->setVariables(array(
                'formSearch'        => $formSearch,
                'tableTitle'        => 'Albo pretorio',
                'tableDescription'  => $tableDescription,
                'columns' => array(
                    array('label' => 'Num \ Anno', 'width' => '10%'),
                    array('label' => 'Titolo', 'width' => '20%'),
                    'Sezione',
                    'Date',
                    'Inserito da',
                    '&nbsp;',
                    '&nbsp;',
                    '&nbsp;',
                    '&nbsp;',
                    '&nbsp;',
                    '&nbsp;',
                ),
                'sessionSearch'     => $sessionSearch,
                'paginator'         => $paginator,
                'records'           => $this->formatArticoliRecords($alboArticoliRecords),
                'templatePartial'   => 'datatable/datatable_albo_pretorio.phtml'
            ));

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                    'messageType'       => 'warning',
                    'messageTitle'      => 'Problema verificato',
                    'messageText'       => $e->getMessage(),
                    'templatePartial'   => 'message.phtml'
                )
            );
        }

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * Format Articoli columns records
         *
         * @param array $records
         * @return array|null
         */
        protected function formatArticoliRecords($records, $modulePrefixLink = 'albo-pretorio')
        {
            $lang = $this->params()->fromRoute('lang');
            $userDetails = $this->layout()->getVariable('userDetails');

            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $record) {

                    /* Attachments button check */
                    if ($userDetails->acl->hasResource("albo_pretorio_attachments")) {
                        $attachmentsButton = array(
                            'type'  => 'attachButton',
                            'href'  => $this->url()->fromRoute('admin/attachments-summary', array(
                                'lang'          => $lang,
                                'module'        => $modulePrefixLink,
                                'referenceId'   => $record['id'],
                            )),
                            'attachmentsFilesCount' => isset($record['attachments']) ? count($record['attachments']) : 0,
                        );
                    }

                    /* Home page button check */
                    if ($userDetails->acl->hasResource("albo_pretorio_homepage") and $record['attivo']==1) {
                        if ($record['home']==0) {
                            $homePutRemoveLink = $this->url()->fromRoute('admin/homepage-management-insert', array(
                                'lang'          => $lang,
                                'referenceid'   => $record['id'],
                                'modulecode'    => 'albo-pretorio',
                                'languageid'    => 1,
                            ));
                        } else {
                            $homePutRemoveLink = $this->url()->fromRoute('admin/homepage-management-delete', array(
                                'lang'          => $lang,
                                'referenceid'   => $record['id'],
                                'modulecode'    => 'albo-pretorio',
                                'languageid'    => 1,
                            ));
                        }

                        $homePageButton = array(
                            'type'  => $record['home']==1 ? 'homepagePutButton' : 'homepageDelButton',
                            'href'  => $homePutRemoveLink,
                        );
                    } else {
                        $homePageButton = '&nbsp;';
                    }

                    /* Unused delete button */
                    if ($userDetails->acl->hasResource("albo_pretorio_delete")) {
                        $deleteButton = array(
                            'type' => 'deleteButton',
                            'href' => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                'lang'                  => $this->params()->fromRoute('lang'),
                                'action'                => 'delete',
                            )),
                            'data-id' => $record['id'],
                            'title'   => 'Elimina articolo'
                        );
                    }

                    $rowClass = '';
                    if ($record['attivo']==0 and $record['annullato']==1) {
                        $rowClass = 'rowHidden';
                    }

                    if (($record['attivo']==1 or $record['attivo']==0) and $record['pubblicare']==0 and $record['annullato']==0) {
                        $rowClass = 'rowNew';
                    }

                    $scadenzaString = ($record['dataScadenza']=='0000-00-00 00:00:00') ? 'Nessuna' : date("d-m-Y", strtotime($record['dataScadenza']));
                    $pubblicareString = ($record['pubblicare']==1) ? date("d-m-Y", strtotime($record['dataPubblicare'])) : 'non ancora pubblicato';
                    $attivareString = ($record['attivo']==1) ? date("d-m-Y", strtotime($record['dataAttivazione'])).' '.$record['oraAttivazione'] : 'Non ancora attivato';
                    $rettificaString = ($record['checkRettifica']==1) ? date("d-m-Y", strtotime($record['dataRettifica'])) : null;
                    $dateString = '<strong>Scadenza:</strong> '.$scadenzaString;
                    $dateString .= '<br><br><strong>Pubblicazione:</strong> '.$pubblicareString;
                    $dateString .= '<br><br><strong>Attivazione:</strong> '.$attivareString;
                    if ($rettificaString != null) {
                        $dateString .= '<br><br><strong>Rettifica:</strong> '.$rettificaString;
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
                            'record' => $dateString,
                            'class'  => $rowClass,
                        ),
                        array(
                            'type'   => 'field',
                            'record' => $record['userName'].' '.$record['userSurname'],
                            'class'  => $rowClass,
                        ),
                    );

                    /* Attachment button */
                    $arrayLine[] = isset($attachmentsButton) ? $attachmentsButton : null;

                    /* Homepage button */
                    $arrayLine[] = isset($homePageButton) ? $homePageButton : null;

                    if ($record['annullato']) {
                        $arrayLine[] = array(
                            'type'  => 'alboAnnulledButton',
                            'class' => $rowClass,
                        );
                    } else {

                        /* Rettifica button */
                        if ($record['pubblicare']==1 and $record['annullato']==0) {
                            $arrayLine[] = array(
                                'type'      => 'alboRettificaButton',
                                'data-form-action' => $this->url()->fromRoute('admin/albo-pretorio-form-rettifica', array(
                                    'lang'  => $lang,
                                    'id'    => $record['id'],
                                )),
                                'title'     => 'Rettifica atto',
                                'data-id'   => $record['id'],
                            );
                        }

                        /* Active button */
                        if ($record['attivo']==0 and $record['pubblicare']==0) {
                            $arrayLine[] = array(
                                'type'      => 'disableButton',
                                'href'      => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                    'lang'      => $lang,
                                    'action'    => 'active',
                                    'id'        => $record['id']
                                )),
                                'value'     => $record['attivo'],
                                'title'     => 'Attiva atto e rendi disponibile la pubblicazione',
                            );
                        }

                        /* Publish button */
                        if ($record['pubblicare']==0 and $record['attivo']==1) {
                            $arrayLine[] = array(
                                'type'      => 'alboPublishButton',
                                'data-form-action' => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                    'lang'   => $lang,
                                    'action' => 'publish',
                                    'anno'   => $record['anno'],
                                )),
                                'data-id'   => $record['id'],
                                'title'     => 'Pubblica articolo',
                            );
                        }

                        /* Edit button */
                        if ($record['pubblicare']==0 and $record['annullato']==0) {
                            $arrayLine[] = array(
                                'type'      => 'updateButton',
                                'href'      => $this->url()->fromRoute('admin/albo-pretorio-form', array(
                                    'lang'  => $lang,
                                    'id'    => $record['id']
                                )),
                                'title'     => 'Modifica atto',
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