<?php

namespace Admin\Controller\Sezioni;

use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SezioniSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page           = $this->params()->fromRoute('page');

        $wrapper = new SezioniGetterWrapper( new SezioniGetter($em) );
        $wrapper->setInput(array(
            'orderBy' => '',

        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);

        $paginator = $wrapper->getPaginator();

        $columns = array("Nome",
            "Colonna",
            "URL",
            "Immagine",
            "&nbsp;",
        );

        if ( $this->layout()->getVariable('userDetails')->acl->hasResource('contenuti_sezioni_delete') ) {
            $columns[] = "&nbsp;";
        }

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Sezioni',
            'tableDescription'  => $paginator->getTotalItemCount().' sezioni presenti',
            'columns'           => $columns,
            'paginator'         => $paginator,
            'records'           => $this->formatRecordsToShowOnTable( $wrapper->setupRecords() ),
            'templatePartial'   => self::summaryTemplate
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param mixed $records
     * @return array
     */
    private function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            $acl = $this->layout()->getVariable('userDetails');
            $publicDirRelativePath = $this->layout()->getVariable('publicDirRelativePath');
            foreach($records as $key => $row) {

                $rowToAdd = array(
                    $row['nome'],
                    $row['colonna'],
                    (!empty($row['url'])) ? '<a href="'.$row['url'].'" target="_blank" title="'.$row['url'].'">Vai al link</a>' : null,
                    !empty($row['image']) ?
                        '<img src="'.$publicDirRelativePath.'/common/icons/'.$row['image'].'" alt="'.$row['image'].'">'
                        : '&nbsp;',
                    array(
                        'type'      => 'updateButton',
                        'href'      => 'formdata/sezioni-contenuti/'.$row['id'],
                        'title'     => 'Modifica'
                    ),
                );

                if ( $acl->acl->hasResource('contenuti_sezioni_delete') ) {
                    $rowToAdd[] = array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['id'],
                        'title'     => 'Elimina sezione'
                    );
                }

                $arrayToReturn[] = $rowToAdd;
            }
        }

        return $arrayToReturn;
    }
}