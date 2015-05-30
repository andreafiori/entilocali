<?php

namespace Admin\Controller\Users\Settori;

use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;

class SettoriSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $wrapper = new UsersSettoriGetterWrapper(new UsersSettoriGetter($em));
        $wrapper->setInput(array(
            'orderBy' => 'settore.nome'
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage($perPage);

        $paginator = $wrapper->getPaginator();
        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle' => 'Settori utenti',
            'tableDescription' => $paginator->getTotalItemCount().' settori utenti',
            'paginator' => $paginator,
            'columns' => array(
                "Nome",
                "Responsabile",
                "&nbsp;",
                "&nbsp;",
            ),
            'records'           => $this->formatRecords($paginatorRecords),
            'paginator'         => $paginator,
            'templatePartial'   => self::summaryTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array $records
     * @return array
     */
    private function formatRecords($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $arrayToReturn[] = array(
                    $row['nome'],
                    $row['name'].' '.$row['surname'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => 'formdata/users-settori/'.$row['id'],
                        'title'     => 'Modifica settore utente'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'title'     => 'Elimina settore utente',
                        'data-id'   => $row['id']
                    ),
                );
            }
        }

        return $arrayToReturn;
    }
}