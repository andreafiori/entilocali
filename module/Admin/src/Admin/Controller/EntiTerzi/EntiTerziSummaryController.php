<?php

namespace Admin\Controller\EntiTerzi;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\EntiTerzi\EntiTerziGetter;
use ModelModule\Model\EntiTerzi\EntiTerziGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  06 April 2015
 */
class EntiTerziSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $translator = $this->getServiceLocator()->get('translator');

        $wrapper = new EntiTerziGetterWrapper( new EntiTerziGetter($em) );
        $wrapper->setInput( array('orderBy' => 'ret.id DESC') );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => $translator->translate('Rubrica enti terzi'),
            'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().$translator->translate(' enti in archivio'),
            'columns' => array(
                "Nome",
                "Email",
                "&nbsp;",
                "&nbsp;",
            ),
            'paginator'         => $wrapper->getPaginator(),
            'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'templatePartial'   => self::summaryTemplate
        ));

        $this->layout()->setTemplate($mainLayout);
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
                                    'lang'  => $this->params()->fromRoute('lang'),
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