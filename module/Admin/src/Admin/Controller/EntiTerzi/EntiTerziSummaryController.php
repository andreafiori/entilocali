<?php

namespace Admin\Controller\EntiTerzi;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\EntiTerzi\EntiTerziGetter;
use ModelModule\Model\EntiTerzi\EntiTerziGetterWrapper;

class EntiTerziSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $userDetails = $this->recoverUserDetails();
        $acl = $userDetails->acl;
        $translator = $this->getServiceLocator()->get('translator');

        $helper = new AlboPretorioControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new EntiTerziGetterWrapper(new EntiTerziGetter($em)),
            array('orderBy' => 'ret.id DESC'),
            $page
        );

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => $translator->translate('Rubrica enti terzi'),
            'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().$translator->translate(' enti in archivio'),
            'columns' => array(
                "Nome",
                "Email",
                "&nbsp;",
                ($acl->hasResource('enti_terzi_delete')) ? "&nbsp;" : null,
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
            $userDetails = $this->recoverUserDetails();
            $acl = $userDetails->acl;

            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {

                    $arrayToPush = array(
                        array(
                            'type' => 'field',
                            'record' => $row['nome'],
                            'class' => '',
                        ),
                        array(
                            'type' => 'field',
                            'record' => $row['email'],
                        ),
                    );

                    if ($acl->hasResource('enti_terzi_update')) {
                        $arrayToPush[] = array(
                            'type'      => 'updateButton',
                            'href'      => $this->url()->fromRoute('admin/enti-terzi-form', array(
                                'lang'  => $this->params()->fromRoute('lang'),
                                'id'    => $row['id'],
                            )),
                            'title'     => 'Modifica ente terzo',
                        );
                    }

                    if ($acl->hasResource('enti_terzi_delete') and $row['nome']!='WebMaster') {
                        $arrayToPush[] = array(
                            'type'      => 'deleteButton',
                            'href'      => '#', // TODO: add link to delete ente
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina ente terzo',
                        );
                    }

                    $arrayToReturn[] = $arrayToPush;
                }
            }

            return $arrayToReturn;
        }
}