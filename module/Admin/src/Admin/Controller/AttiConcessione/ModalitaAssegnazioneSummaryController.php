<?php

namespace Admin\Controller\AttiConcessione;

use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetter;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetterWrapper;
use Application\Controller\SetupAbstractController;

class ModalitaAssegnazioneSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $wrapper = new AttiConcessioneModalitaAssegnazioneGetterWrapper(
            new AttiConcessioneModalitaAssegnazioneGetter($em)
        );
        $wrapper->setInput( array('orderBy' => 'modassegn.id DESC') );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage($perPage);

        $paginator = $wrapper->getPaginator();

        $records = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
                'tableTitle'        => 'Modalit&agrave; assegnazione atti concessione',
                'tableDescription'  => $paginator->getTotalItemCount()." modalit&agrave in archivio",
                'columns' => array(
                    'Nome',
                    '&nbsp;',
                    '&nbsp;',
                ),
                'formBreadCrumbCategory' => array(
                    array(
                        'href'  => $this->url()->fromRoute('admin/users-resp-proc-management', array(
                            'lang' => $this->params()->fromRoute('lang')
                        )),
                        'label' => 'Atti di concessione',
                        'title' => 'Elenco atti di concessione',
                    ),
                ),
                'dataTableActiveTitle' => 'Modalit&agrave; assegnazione',
                'paginator'         => $paginator,
                'records'           => $this->formatArticoliRecords($records),
                'templatePartial'   => self::summaryTemplate
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array $records
         * @return array|null
         */
        private function formatArticoliRecords($records)
        {
            $arrayToReturn = array();
            if (!empty($records)) {
                foreach($records as $key => $record) {

                    $arrayToReturn[] = array(
                        array(
                            'type'   => 'field',
                            'record' => $record['nome'],
                        ),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->url()->fromRoute('admin/atti-concessione-modalita-assegnazione-form', array(
                                'lang'  => $this->params()->fromRoute('lang'),
                                'id'    => $record['id']
                            )),
                            'title'     => 'Modifica modalita assegnazione atti',
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $record['id'],
                            'title'     => 'Elimina modalita assegnazione atti',
                        )
                    );
                }
            }

            return $arrayToReturn;
        }
}