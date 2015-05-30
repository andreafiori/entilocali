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

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');
        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

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
                            'href'      => $this->url()->fromRoute('admin/albo-pretorio-form', array(
                                'lang'  => 'it',
                                'id'    => $record['id']
                            )),
                            'title'     => 'Modifica',
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $record['id'],
                            'title'     => 'Elimina ',
                        )
                    );
                }
            }

            return $arrayToReturn;
        }
}