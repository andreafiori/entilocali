<?php

namespace Admin\Controller\Users;

use ModelModule\Model\Users\UsersControllerHelper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * Users data summary. Users with WebMasters role cannot see other users
 */
class UsersSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page    = $this->params()->fromRoute('page');
        $perPage = $this->params()->fromRoute('perpage');

        $userDetails = $this->layout()->getVariable('userDetails');
        $userRole    = isset($userDetails->role) ? $userDetails->role : '';

        $helper = new UsersControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new UsersGetterWrapper(new UsersGetter($em)),
            array(
                'excludeRoleName' => ($userRole=='WebMaster') ? null : 'WebMaster',
                'orderBy' => 'u.id DESC'
            ),
            $page,
            $perPage
        );

        $paginator = $wrapper->getPaginator();

        $paginatorCount = $paginator->getTotalItemCount();

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Utenti',
            'tableDescription'  => $paginatorCount.' utenti in archivio',
            'paginator'         => $paginator,
            'columns'           => array(
                "Nome e cognome",
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
     * Format users column data
     *
     * @param array $records
     * @return array
     */
    private function formatRecords($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                if (!empty($row['nomeSettore'])) {
                    $settore = array(
                        'type' => 'link',
                        'href' => $this->url()->fromRoute('admin/users-settori-summary', array(
                            'lang' => $this->params()->fromRoute('lang'),
                        )),
                        'label' => $row['nomeSettore'],
                        'title' => 'Vai alla gestione settori utente',
                    );
                } else {
                    $settore = '&nbsp;';
                }

                $arrayToReturn[] = array(
                    $row['name'],
                    array(
                        'type'  => 'link',
                        'href'  => 'mailto:'.$row['email'],
                        'label' => $row['email'],
                        'title' => 'Scrivi a '.$row['name'].' '.$row['surname'],
                    ),
                    array(
                        'type' => 'link',
                        'href' => $this->url()->fromRoute('admin/users-roles-form', array(
                            'lang' => $this->params()->fromRoute('lang'),
                            'id' => $row['roleId']
                        )),
                        'label' => $row['roleName'],
                        'title' => 'Vai alla gestione ruoli e permessi per '.$row['roleName'],
                    ),
                    $settore,
                    $row['lastUpdate'],
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/users-form', array(
                            'lang'   => $this->params()->fromRoute('lang'),
                            'id'     => $row['id']
                        )),
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
