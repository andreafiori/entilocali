<?php

namespace Admin\Controller\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Application\Controller\SetupAbstractController;
use Zend\View\Model\ViewModel;

/**
 * @author Andrea Fiori
 * @since  06 April 2015
 */
class AlboPretorioSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');
        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($em) );
        $wrapper->setInput(array(
            'orderBy' => 'alboArticoli.id DESC'
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage($perPage);

        $paginator = $wrapper->getPaginator();

        $records = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
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
                ),
                'paginator'         => $paginator,
                'records'           => $this->formatArticoliRecords($records),
                'templatePartial'   => self::summaryTemplate
            )
        );

        $this->layout()->setTemplate($mainLayout);

        return new ViewModel();
    }

        /**
         * @param array $records
         * @return array|null
         */
        protected function formatArticoliRecords($records, $modulePrefixLink = 'albo-pretorio')
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $record) {

                    $rowClass = '';
                    if ($record['attivo']==0) {
                        $rowClass = 'rowHidden';
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
                        'href'  => $this->url()->fromRoute('admin/formdata', array(
                            'lang'          => 'it',
                            'formsetter'    => 'attachments',
                            'option'        => $modulePrefixLink,
                            'id'            => $record['id']
                        )),
                        'class' => $rowClass,
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
                                    'lang'      => 'it',
                                    'id'        => $record['id'],
                                )),
                                'title'     => 'Rettifica articolo',
                                'data-id'   => $record['id'],
                                'class'     => $rowClass,
                            );

                            /* Homepage button */
                            $arrayLine[] = array(
                                'type'      => $record['home']==1 ? 'homepagePutButton' : 'homepageDelButton',
                                'href'      => '#',
                                'value'     => $record['home']==1 ? 1 : 0,
                            );

                        } else {
                            /* Publish button */
                            $arrayLine[] = array(
                                'type'      => 'alboPublishButton',
                                'data-form-action' => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                    'lang'          => 'it',
                                    'action'        => 'publish'
                                )),
                                'data-id'   => $record['id'],
                                'title'     => 'Pubblica articolo',
                                'class'     => $rowClass,
                            );
                            /* Update button */
                            $arrayLine[] = array(
                                'type'      => 'updateButton',
                                'href'      => $this->url()->fromRoute('admin/albo-pretorio-form', array(
                                    'lang'  => 'it',
                                    'id'    => $record['id']
                                )),
                                'title'     => 'Modifica articolo',
                                'class'     => $rowClass,
                            );
                        }
                        /* Relata PDF button */
                        $arrayLine[] = array(
                            'type'   => 'relatapdfButton',
                            'href'   => 'albo-pretorio/relata/pdf/'.$record['id'],
                            'class'  => $rowClass,
                        );
                        /* Invio enti terzi button */
                        $arrayLine[] = array(
                            'type'   => 'enteterzoButton',
                            'href'   => $this->url()->fromRoute('admin/invio-ente-terzo', array(
                                'lang'          => 'it',
                                'modulename'    => $modulePrefixLink,
                                'id'            => $record['id'],
                            )),
                            'class'  => $rowClass,
                        );
                        /* Annull button if published */
                        if ($record['pubblicare']==1) {
                            $arrayLine[] = array(
                                'type'      => 'alboAnnullButton',
                                'data-form-action' => $this->url()->fromRoute('admin/albo-pretorio-operations', array(
                                    'lang'          => 'it',
                                    'action'        => 'annull'
                                )),
                                'href'      => '#',
                                'data-id'   => $record['id'],
                                'title'     => 'Annulla articolo',
                                'class'     => $rowClass,
                            );
                        }
                    }

                    $arrayToReturn[] = $arrayLine;
                }
            }

            return $arrayToReturn;
        }
}