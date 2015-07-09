<?php

namespace Admin\Controller\ContrattiPubblici\Operatori;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetterWrapper;

/**
 * Contratti Pubblici Operatori List index
 */
class ContrattiPubbliciOperatoriSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang       = $this->params()->fromRoute('lang');
        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $helper = new ContrattiPubbliciControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new OperatoriGetterWrapper(new OperatoriGetter($em)),
            array('orderBy' => 'operatori.id DESC'),
            $page,
            $perPage
        );

        $paginator = $wrapper->getPaginator();

        $paginatorRecords = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Aziende contratti pubblici',
            'tableDescription'  => $paginator->getTotalItemCount().' aziende in archivio',
            'columns' => array(
                "Nome",
                "CF",
                "Ragione sociale",
                "&nbsp;",
                "&nbsp;",
            ),
            'paginator'         => $paginator,
            'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'dataTableActiveTitle' => 'Aziende',
            'formBreadCrumbCategory' => array(
                array(
                    'label' => 'Contratti pubblici',
                    'href'  =>  $this->url()->fromRoute('admin/contratti-pubblici-summary',
                        array('lang' => $lang)
                    ),
                    'title' => 'Elenco contratti pubblici',
                ),
            ),
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
                    $row['nome'],
                    $row['cf'],
                    $row['ragioneSociale'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->url()->fromRoute('admin/contratti-pubblici-operatori-form', array(
                            'lang'  => $lang,
                            'id'    => $row['id']
                        )),
                        'title'     => 'Modifica dati azienda'
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