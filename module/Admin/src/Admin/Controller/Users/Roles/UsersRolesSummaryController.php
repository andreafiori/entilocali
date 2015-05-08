<?php

namespace Admin\Controller\Users\Roles;

use Admin\Model\Users\Roles\UsersRolesGetter;
use Admin\Model\Users\Roles\UsersRolesGetterWrapper;
use Application\Controller\SetupAbstractController;

class UsersRolesSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new UsersRolesGetterWrapper( new UsersRolesGetter($em) );
        $wrapper->setInput(array(
            'orderBy' => 'role.id DESC'
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);

        $paginator = $wrapper->getPaginator();

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
                'tableTitle'                     => 'Gestione ruoli utenti',
                'tableDescription'               => $paginator->getTotalItemCount().' ruoli utente',
                'columns' => array(
                    "Nome",
                    "Data inserimento",
                    "Ultimo aggiornamento",
                    "&nbsp;",
                    "&nbsp;",
                ),
                'records'                       => $this->formatRecords($paginatorRecords),
                'formBreadCrumbCategory'        => 'Ruoli utente',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/users-summary', array('lang' => 'it')),
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
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        $row['name'],
                        $row['insertDate'],
                        $row['lastUpdate'],
                        ($row['name']=='WebMaster') ? '&nbsp;' :
                            array(
                                'type'      => 'updateButton',
                                'href'      => $this->url()->fromRoute('admin/users-roles-form', array('lang' => 'it', 'id' => $row['id'])),
                                'data-id'   => $row['id'],
                                'title'     => 'Modifica ruolo utente'
                            ),
                        ($row['name']=='WebMaster') ? '&nbsp;' :
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