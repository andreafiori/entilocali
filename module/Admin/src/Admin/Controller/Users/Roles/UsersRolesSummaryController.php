<?php

namespace Admin\Controller\Users\Roles;

use ModelModule\Model\Users\Roles\UsersRolesControllerHelper;
use ModelModule\Model\Users\Roles\UsersRolesGetter;
use ModelModule\Model\Users\Roles\UsersRolesGetterWrapper;
use Application\Controller\SetupAbstractController;

class UsersRolesSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');
        $lang = $this->params()->fromRoute('lang');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $userDetails = $this->recoverUserDetails();
        $acl = $userDetails->acl;

        $helper = new UsersRolesControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new UsersRolesGetterWrapper(new UsersRolesGetter($em)),
            array(
                'orderBy' => 'role.id DESC'
            ),
            $page,
            null
        );

        $paginator = $wrapper->getPaginator();

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
                'tableTitle'                     => 'Gestione ruoli utenti',
                'tableDescription'               => $paginator->getTotalItemCount()." ruoli utente. Gestione ruoli e permessi. Per ragioni di gestione dati e sicurezza, il ruolo di WebMaster non pu&ograve; essere modificato o eliminato ",
                'columns' => array(
                    "Nome",
                    "Data inserimento",
                    "Ultimo aggiornamento",
                    "&nbsp;",
                    ($acl->hasResource('users_roles_delete')) ? "&nbsp;" : null,
                ),
                'records'                       => $this->formatRecords($paginatorRecords),
                'formBreadCrumbCategory' => array(
                    array(
                        'label' => 'Utenti',
                        'href'  =>  $this->url()->fromRoute('admin/users-summary', array('lang' => $lang) ),
                        'title' => 'Elenco utenti',
                    ),
                    array(
                        'label' => 'Ruoli',
                        'href'  =>  $this->url()->fromRoute('admin/users-roles-summary', array('lang' => $lang)),
                        'title' => 'Elenco ruoli',
                    ),
                ),
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/users-summary', array('lang' => $lang)),
                'templatePartial'               => self::summaryTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param mixed $records
         * @return array
         */
        private function formatRecords($records)
        {
            $lang = $this->params()->fromRoute('lang');
            $userDetails = $this->recoverUserDetails();
            $acl = $userDetails->acl;

            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToPush = array(
                        $row['name'],
                        $row['insertDate'],
                        $row['lastUpdate'],
                    );

                    if ($acl->hasResource('users_roles_update') and $row['name']!='WebMaster') {
                        $arrayToPush[] = array(
                            'type'      => 'updateButton',
                            'href'      => $this->url()->fromRoute('admin/users-roles-form', array(
                                'lang'  => $lang,
                                'id'    => $row['id']
                            )),
                            'data-id'   => $row['id'],
                            'title'     => 'Modifica ruolo utente'
                        );
                    } elseif ($acl->hasResource('users_roles_update')) {
                        $arrayToPush[] = '&nbsp;';
                    }

                    if ($acl->hasResource('users_roles_delete') and $row['name']!='WebMaster') {
                        $arrayToPush[] = array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina ruolo utente'
                        );
                    } elseif ($acl->hasResource('users_roles_delete')) {
                        $arrayToPush[] = '&nbsp;';
                    }

                    $arrayToReturn[] = $arrayToPush;
                }
            }

            return $arrayToReturn;
        }
    }