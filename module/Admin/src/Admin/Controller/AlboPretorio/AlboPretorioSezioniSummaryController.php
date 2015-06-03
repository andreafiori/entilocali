<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioSezioniSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');
        $perPage = $this->params()->fromRoute('perpage');
        $lang = $this->params()->fromRoute('lang');

        $helper = new AlboPretorioControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em)),
            array('orderBy' => ''),
            $page,
            $perPage
        );

        $paginator = $wrapper->getPaginator();

        $paginatorRecordsCount = $paginator->getTotalItemCount();

        $paginatorRecords = $this->formatRecords($wrapper->setupRecords());

        $this->layout()->setVariables( array(
                'tableTitle' => 'Sezioni albo pretorio',
                'tableDescription' => $paginatorRecordsCount.' sezioni albo pretorio in archivio',
                'columns' => array(
                    "Nome",
                    "Stato",
                    "&nbsp;",
                    "&nbsp;",
                ),
                'dataTableActiveTitle' => 'Sezioni',
                'formBreadCrumbCategory' => array(
                    array(
                      'label' => 'Albo pretorio',
                      'href'  =>  $this->url()->fromRoute('admin/albo-pretorio-sezioni-summary',
                          array('lang' => $lang)
                      ),
                      'title' => 'Albo pretorio',
                    ),
                ),
                'paginator'         => $paginator,
                'records'           => $paginatorRecords,
                'templatePartial'   => self::summaryTemplate
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array $records
     * @return array
     */
    public function formatRecords($records)
    {
        if ( !empty($records) ) {

            $arrayToReturn = array();

            foreach($records as $record) {

                $arrayToReturn[] = array(
                    $record['nome'],
                    ($record['attivo']==1) ? 'Attivo' : 'Nascosto',
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->url()->fromRoute('admin/albo-pretorio-sezioni-form', array(
                            'lang'  => 'it',
                            'id'    => $record['id']
                        )),
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $record['id'],
                        'title'     => 'Elimina'
                    ),
                );
            }

            return $arrayToReturn;
        }

        return false;
    }
}