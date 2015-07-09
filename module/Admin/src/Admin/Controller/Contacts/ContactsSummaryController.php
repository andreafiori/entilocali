<?php

namespace Admin\Controller\Contacts;

use ModelModule\Model\Contacts\ContactsGetter;
use ModelModule\Model\Contacts\ContactsGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * Contacts index messages list
 */
class ContactsSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new ContactsControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new ContactsGetterWrapper(new ContactsGetter($em)),
            array('orderBy' => 'ret.id DESC'),
            $page,
            null
        );

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Messaggi ricevuti',
            'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().' messaggi ricevuti dal sito pubblico',
            'columns' => array(
                "Nome e cognome",
                "Email",
                "Data invio",
                "&nbsp;"
            ),
            'paginator'         => $wrapper->getPaginator(),
            'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'templatePartial'   => self::summaryTemplate
        ));

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array $records
         * @return array
         */
        private function formatRecordsToShowOnTable($records)
        {
            if (empty($records)) {
                return false;
            }

            $recordsToReturn = array();
            foreach($records as $record) {
                $recordsToReturn[] = array(
                    $record['name'].' '.$record['surname'],
                    $record['email'],
                    $record['insertDate'],
                    array(
                        'id' => 'deleteButton',
                        'type'      => 'deleteButton',
                        'title'     => 'Elimina',
                        'href'      => '#',
                        'data-id'   => $record['id'],
                    ),
                );
            }

            return $recordsToReturn;
        }
}