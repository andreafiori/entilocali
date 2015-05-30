<?php

namespace Admin\Controller\StatoCivile\Sezioni;

use ModelModule\Model\StatoCivile\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class StatoCivileSezioniSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $wrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($em) );
        $wrapper->setInput( array('orderBy' => 'scs.id DESC') );
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : null);
        $wrapper->setupPaginatorItemsPerPage(isset($perPage) ? $perPage : null);

        $paginator = $wrapper->getPaginator();

        $paginatorCount = $paginator->getTotalItemCount();

        $this->layout()->setVariables(array(
                'tableTitle'        => 'Sezioni stato civile',
                'tableDescription'  => $paginatorCount.' sezioni stato civile in archivio',
                'columns'           => array(
                    "Nome",
                    "Data inserimento",
                    "Data ultimo aggiornamento",
                    "&nbsp;",
                    "&nbsp;",
                ),
                'paginator'                     => $paginator,
                'total_item_count'              => $paginatorCount,
                'records'                       => $this->formatRecords( $wrapper->setupRecords() ),
                'formBreadCrumbCategory'        => 'Stato civile',
                'templatePartial'               => self::summaryTemplate,
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/stato-civile-sezioni-summary', array(
                    'lang' => 'it'
                )),
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array!null $records
     *
     * @return boolean
     */
    private function formatRecords($records)
    {
        if (!empty($records)) {
            $recordsToReturn = array();
            foreach($records as $record) {
                $recordsToReturn[] = array(
                    $record['nome'],
                    $record['dataInserimento'],
                    $record['dataUltimoAggiornamento'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->url()->fromRoute('admin/stato-civile-sezioni-form', array(
                            'lang'  => 'it',
                            'id'    => $record['id']
                        )),
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $record['id'],
                        'title'     => 'Elimina'
                    ),
                );
            }

            return $recordsToReturn;
        }

        return false;
    }
}