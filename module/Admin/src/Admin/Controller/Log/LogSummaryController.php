<?php

namespace Admin\Controller\Log;

use ModelModule\Model\Log\LogGetter;
use ModelModule\Model\Log\LogGetterWrapper;
use Application\Controller\SetupAbstractController;

class LogSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new LogGetterWrapper(new LogGetter($em));
        $wrapper->setInput(array(
            'orderBy' => 'l.datetime DESC'
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator($wrapper->setupQuery($em));
        $wrapper->setupPaginatorCurrentPage($page);

        $paginatorRecords =  $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Tracciamento operazioni eseguite',
            'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().' operazioni loggate',
            'columns' => array(
                "Data \ ora",
                "Messaggio",
                "Utente",
                "Tipo",
                "Area",
                "&nbsp;",
            ),
            'paginator'         => $wrapper->getPaginator(),
            'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'templatePartial'   => 'datatable/datatable_logs.phtml'
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array $records
     * @return array
     */
    private function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                $arrayToReturn[]  = array(
                    $row['datetime'],
                    $row['message'],
                    $row['name'].' '.$row['surname'],
                    $row['type'],
                    $row['backend'],
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['id'],
                        'title'     => 'Elimina log'
                    ),
                );
            }
        }

        return $arrayToReturn;
    }
}