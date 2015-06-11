<?php

namespace Admin\Controller\Tickets;

use ModelModule\Model\Tickets\TicketsGetter;
use ModelModule\Model\Tickets\TicketsGetterWrapper;
use Application\Controller\SetupAbstractController;

class TicketsSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $translator = $this->getServiceLocator()->get('translator');

        $wrapper = new TicketsGetterWrapper( new TicketsGetter($em) );
        $wrapper->setInput(array(
            'orderBy' => 't.id DESC',
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);

        $records = $wrapper->getRecords();

        $arrayToReturn = array();
        if ( is_array($records) ) {
            foreach($records as $record) {
                $arrayToReturn[] = array(
                    isset($record['title']) ? $record['title'] : null,
                    isset($record['subject']) ? $record['subject'] : null,
                    isset($record['priority']) ? $record['priority'] : null,
                    isset($record['createDate']) ? $record['createDate'] : null,
                    'Risolvi',
                    'Rispondi',
                );
            }
        }

        $this->layout()->setVariables(array(
            'tableTitle'        => $translator->translate('Assistenza'),
            'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().$translator->translate(' richiesta\e di assistenze in archivio'),
            'columns' => array(
                "Oggetto",
                "Messaggio",
                "Priorit&agrave;",
                "Creato il"
            ),
            'paginator'         => $wrapper->getPaginator(),
            'records'           => $arrayToReturn,
            'templatePartial'   => self::summaryTemplate
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}