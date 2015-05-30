<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class StatoCivileDataTable extends DataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $formSearch = new StatoCivileFormSearch();
        $formSearch->addSubmitButton();
        $formSearch->addCheckExpired();
        $formSearch->addYears($this->getYears());
        
        $this->checkActiveDisable();
        
        $wrapper = $this->getStatoCivileGetterWrapper();
        $paginatorCount = $wrapper->getPaginator()->getTotalItemCount();

        $this->setTitle('Stato civile');
        $this->setDescription($paginatorCount.' atti stato civile in archivio');
        $this->setColumns( array(
                "Titolo",
                "Numero / Anno",
                "Sezione",
                "Inserito il",
                "Scadenza",
                "Inserito da",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
                "&nbsp;",
            )
        );

        $this->setVariables(array(
            'paginator'         => $wrapper->getPaginator(),
            'total_item_count'  => $paginatorCount,
            'tablesetter'       => 'stato-civile',
            'formSearch'        => $formSearch,
            'formExport'        => $formSearch
            )
        );

        $this->setRecords($this->getFormattedRecords($wrapper->setupRecords()));
        
        $this->setTemplate('datatable/datatable_statocivile.phtml');
    }

        /**
         * @return array|bool
         */
        private function getYears()
        {
            $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager', 1)) );
            $statoCivileGetterWrapper->setInput( array('fields' => 'DISTINCT(sca.anno) AS anno') );
            $statoCivileGetterWrapper->setupQueryBuilder();
            
            $years = $statoCivileGetterWrapper->getRecords();
            if ($years) {
                $yearsList = array();
                foreach($years as $year) {
                    $yearsList[$year['anno']] = $year['anno'];
                }

                return $yearsList;
            }

            return false;
        }
        
        /**
         * @return StatoCivileGetterWrapper
         */
        private function getStatoCivileGetterWrapper()
        {
            $param = $this->getInput('param', 1);

            $wrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('orderBy' => 'sca.id DESC') );
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery( $this->getInput('entityManager', 1) ) );
            $wrapper->setupPaginatorCurrentPage(isset($param['route']['page']) ? $param['route']['page'] : null);
            $wrapper->setupPaginatorItemsPerPage(isset($param['route']['perpage']) ? $param['route']['perpage'] : null);

            return $wrapper;
        }
        
        /**
         * @param array|null $records
         * @return boolean|array
         */
        private function getFormattedRecords($records)
        {
            if (!$records) {
                return false;
            }

            $recordsToReturn = array();
            foreach($records as $record) {
                $activeDisableButtonValue = ($record['attivo']!=0) ? 'toDisable' : 'toActive';
                $recordsToReturn[] = array(
                    $record['titolo'],
                    $record['progressivo'].' / '.$record['anno'],
                    $record['nome'],
                    $record['data'],
                    $record['scadenza'],
                    $record['user_name_surname'],
                    array(
                        'type'      => $record['attivo']!=0 ? 'activeButton' : 'disableButton',
                        'href'      => '?active='.$activeDisableButtonValue.'&amp;id='.$record['id'],
                        'value'     => $record['attivo'],
                        'title'     => 'Attiva \ Disattiva'
                    ),
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/stato-civile/'.$record['id'],
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'attachButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/attachments/stato-civile/'.$record['id'],
                    ),
                    array(
                        'type'      => 'enteterzoButton',
                        'href'      => $this->getInput('baseUrl',1).'invio-ente-terzo/stato-civile/'.$record['id'],
                        'title'     => 'Invia ad ente terzo'
                    ),
                );
            }

            return $recordsToReturn;
        }
        
        /**
        * Check if the user has requested to enable or disable the article
        */
        private function checkActiveDisable()
        {
            if (isset($this->param['get']['active']) and isset($this->param['get']['id'])) {

                $activeStatusValue = null;

                if ($this->param['get']['active']=='toActive') {
                    $activeStatusValue = 1;
                } elseif ($this->param['get']['active']=='toDisable') {
                    $activeStatusValue = 0;
                }

                /**
                 * @var \Doctrine\DBAL\Connection $connection
                 */
                $connection = $this->getInput('entityManager',1)->getConnection();
                $connection->beginTransaction();
                try {
                    $connection->update('zfcms_comuni_stato_civile_articoli', array(
                            'attivo' => $activeStatusValue
                        ),
                        array('id' => $this->param['get']['id'])
                    );
                    $connection->commit();
                } catch (\Exception $e) {
                    $connection->rollBack();

                    return $e->getMessage();
                }
            }

            return null;
        }
}
