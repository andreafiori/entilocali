<?php

namespace Admin\Controller\Users;

use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Controller\SetupAbstractController;

class UsersSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $wrapper = new UsersGetterWrapper(new UsersGetter($em) );
        $wrapper->setInput( array('orderBy' => 'u.id DESC') );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage( isset($page) ? $page : null );
        $wrapper->setupPaginatorItemsPerPage($perPage);

        $paginator = $wrapper->getPaginator();

        $paginatorCount = $paginator->getTotalItemCount();

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle' => 'Utenti',
            'tableDescription' => $paginatorCount.' utenti in archivio',
            'paginator'   => $paginator,
            'columns'     => array(
                "Nome e Cognome",
                "Email",
                "Ruolo",
                "Settore",
                "Ultima modifica",
                "&nbsp;",
                "&nbsp;",
            ),
            'records'           => $this->formatRecords($paginatorRecords),
            'paginator'         => $paginator,
            'total_item_count'  => $paginatorCount,
            'templatePartial'   => self::summaryTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param mixed $records
     * @return array
     */
    private function formatRecords($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $arrayToReturn[] = array(
                    $row['name'],
                    '<a href="mailto:'.$row['email'].'" title="Scrivi a '.$row['name'].' '.$row['surname'].'">'.$row['email'].'</a>',
                    ($row['roleName']!='WebMaster') ?
                        '<a href="users/roles/permissions/'.$row['roleId'].'" title="">'.$row['roleName'].'</a>'
                        : $row['roleName'],
                    $row['nome'],
                    $row['lastUpdate'],
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/users-form', array(
                                'lang'   => 'it',
                                'id'     => $row['id']
                            )
                        ),
                        'title' => 'Modifica utente'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'title'     => 'Elimina utente',
                        'data-id'   => $row['id']
                    ),
                );
            }
        }

        return $arrayToReturn;
    }
}