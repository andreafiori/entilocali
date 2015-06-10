<?php

namespace Admin\Controller\Users;

use ModelModule\Model\Users\UsersControllerHelper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use Application\Controller\SetupAbstractController;

class UsersSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $helper = new UsersControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new UsersGetterWrapper(new UsersGetter($em)),
            array('orderBy' => 'u.id DESC'),
            $page,
            $perPage
        );

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
     * @param array $records
     * @return array
     */
    private function formatRecords($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                if ($row['roleName']!='WebMaster') {
                    $role = array(
                        'type' => 'link',
                        'href' => $this->url()->fromRoute('admin/users-roles-form', array(
                            'lang' => $this->params()->fromRoute('lang'),
                            'id' => $row['roleId']
                        )),
                        'label' => $row['roleName'],
                        'title' => 'Vai alla gestione ruoli e permessi per '.$row['roleName'],
                    );
                } else {
                    $role = $row['roleName'];
                }

                $arrayToReturn[] = array(
                    $row['name'],
                    '<a href="mailto:'.$row['email'].'" title="Scrivi a '.$row['name'].' '.$row['surname'].'">'.$row['email'].'</a>',
                    $role,
                    (!empty($row['nomeSettore'])) ? $row['nomeSettore'] : '&nbsp;',
                    $row['lastUpdate'],
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/users-form', array(
                                'lang'   => $this->params()->fromRoute('lang'),
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
