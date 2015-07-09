<?php

namespace Admin\Controller\Newsletter;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Newsletter\NewsletterControllerHelper;
use ModelModule\Model\Newsletter\NewsletterGetter;
use ModelModule\Model\Newsletter\NewsletterGetterWrapper;

class NewsletterSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new NewsletterControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new NewsletterGetterWrapper(new NewsletterGetter($em)),
            array(
                'orderBy' => ''
            ),
            $page
        );

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Newsletter',
            'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().' newsletter in archivio',
            'columns' => array(
                "Titolo",
                "Messaggio",
                "Data creazione",
                "Inviata",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
            ),
            'paginator'         => $wrapper->getPaginator(),
            'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'templatePartial'   => self::summaryTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array $records
     * @return array
     */
    private function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {

                $arrayToPush = array(
                    $row['title'],
                    $row['messageText'],
                    $row['createDate'],
                    ($row['sent']!=0) ? 'Si' : 'No',
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->url()->fromRoute('admin/newsletter-form', array(
                            'lang'  => $this->params()->fromRoute('lang'),
                            'id'    => $row['id'],
                        )),
                        'title'     => 'Modifica newsletter',
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['id'],
                        'title'     => 'Elimina newsletter'
                    ),
                    array(
                        'type'      => 'link',
                        'href'      => '#',
                        'label'     => 'Invia',
                        'title'     => 'Invia newsletter'
                    ),
                );

                $arrayToReturn[] = $arrayToPush;
            }
        }

        return $arrayToReturn;
    }
}