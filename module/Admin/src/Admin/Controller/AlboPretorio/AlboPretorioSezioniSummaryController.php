<?php

namespace Admin\Controller\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioSezioniSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();
        $page = $this->params()->fromRoute('page');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($em) );
        $wrapper->setInput( array('orderBy' => '') );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage( isset($page) ? $page : null );

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