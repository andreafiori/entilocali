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

        $wrapper = new EntiTerziGetterWrapper( new EntiTerziGetter($entityManager) );
        $wrapper->setInput( array('orderBy' => 'ret.id DESC') );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($entityManager) );
        $wrapper->setupPaginatorCurrentPage( isset($page) ? $page: null );

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tablesetter'       => 'enti-terzi',
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

        return $this->layout($mainLayout);
    }

        /**
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
                            'href'      => $this->url()->fromRoute('admin/formdata', array(
                                    'lang'          => 'it',
                                    'formsetter'    => 'enti-terzi',
                                    'id'            => $row['id']
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