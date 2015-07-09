<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;

class ContrattiPubbliciSceltaContraenteSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new ContrattiPubbliciControllerHelper();

        $sceltaContraenteWrapper = $helper->recoverWrapperRecordsPaginator(
            new SceltaContraenteGetterWrapper(new SceltaContraenteGetter($em)),
            array(),
            $page,
            null
        );

        $paginator = $sceltaContraenteWrapper->getPaginator();

        $paginatorRecords = $sceltaContraenteWrapper->setupRecords();

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Voci scelta contraente sui contratti pubblici',
            'tableDescription'  => $paginator->getTotalItemCount().' voci scelta contraente in archivio',
            'columns' => array(
                "Nome",
                "Stato",
                "&nbsp;",
                "&nbsp;",
            ),
            'paginator'               => $paginator,
            'records'                 => $this->formatRecordsToShowOnTable($paginatorRecords),
            'dataTableActiveTitle'    => 'Voci scelta contraente',
            'formBreadCrumbCategory' => array(
                array(
                    'href' =>   $this->url()->fromRoute('admin/contratti-pubblici-summary', array(
                        'lang' => $this->params()->fromRoute('lang')
                    )),
                    'title' => 'Elenco contratti pubblici',
                    'label' => 'Contratti pubblici'
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
        private function formatRecordsToShowOnTable($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        $row['nomeScelta'],
                        ($row['attivo']==1) ? 'Attivo' : 'Nascosto',
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->url()->fromRoute('admin/contratti-pubblici-scelta-contraente-form', array(
                                'lang'  => $this->params()->fromRoute('lang'),
                                'id'    => $row['id'],
                            )),
                            'title'     => 'Modifica voce scelta contraente'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'title'     => 'Elimina voce scelta contraente',
                            'data-id'   => $row['id']
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}