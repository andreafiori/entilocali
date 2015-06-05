<?php

namespace Admin\Controller\ContrattiPubblici\Operatori;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetterWrapper;

class ContrattiPubbliciOperatoriSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $helper = new ContrattiPubbliciControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new OperatoriGetterWrapper(new OperatoriGetter($em)),
            array('orderBy' => ''),
            $page,
            $perPage
        );

        $paginator = $wrapper->getPaginator();

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Aziende contratti pubblici',
            'tableDescription'  => $paginator->getTotalItemCount().' aziende in archivio',
            'columns' => array(
                "CF",
                "Ragione sociale",
                "Nome",
                "Ruolo",
                "&nbsp;",
                "&nbsp;",
            ),
            'paginator'         => $paginator,
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
        $lang = $this->params()->fromRoute('lang');

        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $arrayToReturn[] = array(
                    $row['cf'],
                    $row['ragioneSociale'],
                    $row['nome'],
                    $row['ruolo1'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->url()->fromRoute('admin/contratti-pubblici-operatori-form', array(
                            'lang'  => $lang,
                            'id'    => $row['id']
                        )),
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'title'     => 'Elimina',
                        'data-id'   => $row['id']
                    ),
                );
            }
        }

        return $arrayToReturn;
    }
}