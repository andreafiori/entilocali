<?php

namespace Admin\Controller\Sezioni;

use Application\Controller\SetupAbstractController;

class SezioniSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $moduleCode     = $this->params()->fromRoute('module');

        $id             = $this->params()->fromRoute('id');

        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');


        $wrapper = new SezioniGetterWrapper( new SezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
        $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

        $records = $wrapper->setupRecords();
        $recordsCount = $wrapper->getPaginator()->getTotalItemCount();

        $this->setRecords( $this->formatRecordsToShowOnTable($records) );

        $columns = array(
            "Nome",
            "Colonna",
            "URL",
            "Immagine",
            "&nbsp;",
        );

        if ($this->getAcl()->hasResource('contenuti_sezioni_delete')) {
            $columns[] = "&nbsp;";
        }

        $this->setVariables(array(
            'paginator'   => $records,
            'item_count'  => $recordsCount,
            'columns'     => $columns,
        ));

        $this->setTitle('Sezioni');

        $this->setDescription($recordsCount.' sezioni presenti');
    }

    /**
     * @param mixed $records
     * @return array
     */
    private function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                $rowToAdd = array(
                    $row['nome'],
                    $row['colonna'],
                    (!empty($row['url'])) ? '<a href="'.$row['url'].'" target="_blank" title="'.$row['url'].'">Vai al link</a>' : null,
                    !empty($row['image']) ?
                        '<img src="'.$this->getInput('basePath',1).'public/common/icons/'.$row['image'].'" alt="">'
                        : '&nbsp;',
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/sezioni-contenuti/'.$row['id'],
                        'title'     => 'Modifica'
                    ),
                );

                if ($this->getAcl()->hasResource('contenuti_sezioni_delete')) {
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