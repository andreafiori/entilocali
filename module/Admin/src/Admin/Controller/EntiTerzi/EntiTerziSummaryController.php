<?php

namespace Admin\Controller\EntiTerzi;

use Application\Controller\SetupAbstractController;
use Admin\Model\EntiTerzi\EntiTerziGetter;
use Admin\Model\EntiTerzi\EntiTerziGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  06 April 2015
 */
class EntiTerziSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $templateDir = $this->layout()->getVariable('templateDir');

        $page = $this->params()->fromRoute('page');

        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $translator = $this->getServiceLocator()->get('translator');

        $wrapper = $this->recoverEntiTerziGetterWrapper($entityManager, $page);

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'paginator'         => $wrapper->getPaginator(),
            'tableTitle'        => $translator->translate('Rubrica enti terzi'),
            'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().$translator->translate(' enti in archivio'),
            'columns' => array(
                "Nome",
                "Email",
                "&nbsp;",
                "&nbsp;",
            ),
            'records' => $this->formatRecordsToShowOnTable($paginatorRecords)
        ));

        $this->layout()->setVariable('templatePartial', $templateDir.'datatable/datatable.phtml');

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * Recover Enti Terzi Object Wrapper
         *
         * @param $entityManager
         * @param int $page
         * @return EntiTerziGetterWrapper
         */
        private function recoverEntiTerziGetterWrapper($entityManager, $page)
        {
            $wrapper = new EntiTerziGetterWrapper(new EntiTerziGetter($entityManager));
            $wrapper->setInput(array('orderBy' => 'ret.id DESC'));
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator($wrapper->setupQuery($entityManager));
            $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : null);

            return $wrapper;
        }

        /**
         * Format columns enti terzi records
         *
         * @param mixed $records
         * @return array
         */
        private function formatRecordsToShowOnTable($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {

                    $arrayToReturn[] = array(
                        array(
                            'type' => 'field',
                            'record' => $row['nome'],
                            'class' => '',
                        ),
                        array(
                            'type' => 'field',
                            'record' => $row['email'],
                        ),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->url()->fromRoute('admin/enti-terzi-form', array(
                                    'lang'  => 'it',
                                    'id'    => $row['id'],
                                )
                            ),
                            'title'     => 'Modifica ente terzo',
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina ente terzo',
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}