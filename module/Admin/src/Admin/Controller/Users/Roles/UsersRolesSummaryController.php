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
                'tableDescription'               => $paginator->getTotalItemCount()." ruoli utente. Gestione ruoli e permessi.",
                'columns' => array(
                    "Nome",
                    "Data inserimento",
                    "Ultimo aggiornamento",
                    "&nbsp;",
                    "&nbsp;",
                ),
                'records'                       => $this->formatRecords($paginatorRecords),
                'formBreadCrumbCategory'        => 'Ruoli utente',
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

            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        $row['name'],
                        $row['insertDate'],
                        $row['lastUpdate'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->url()->fromRoute('admin/users-roles-form', array(
                                'lang'  => $lang,
                                'id'    => $row['id']
                            )),
                            'data-id'   => $row['id'],
                            'title'     => 'Modifica ruolo utente'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina ruolo utente'
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
    }