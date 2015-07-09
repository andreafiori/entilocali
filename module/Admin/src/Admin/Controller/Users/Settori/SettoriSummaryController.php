<?php

namespace Admin\Controller\Users\Settori;

use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Users\UsersControllerHelper;

class SettoriSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang       = $this->params()->fromRoute('lang');
        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $helper = new UsersControllerHelper();

        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
            array('orderBy' => 'settore.id DESC'),
            $page,
            $perPage
        );

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
            'records'                => $this->formatRecords($paginatorRecords),
            'paginator'              => $paginator,
            'dataTableActiveTitle'   => 'Settori',
            'formBreadCrumbCategory' => array(
                array(
                    'label' => 'Utenti',
                    'href'  =>  $this->url()->fromRoute('admin/users-summary',
                        array('lang' => $lang)
                    ),
                    'title' => 'Elenco utenti',
                ),
            ),
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
                        'href'      => $this->url()->fromRoute('admin/users-settori-form', array(
                            'lang' => $this->params()->fromRoute('lang'),
                            'id'   => $row['id'],
                        )),
                        'title' => 'Modifica settore utente'
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