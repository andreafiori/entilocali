<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class StatoCivileDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->setTitle('Stato civile');
        $this->setDescription('Gestione atti stato civile');
        $this->setColumns( array(
            "Titolo", 
            "Numero / Anno", 
            "Sezione", 
            "Inserito il", 
            "Scadenza", 
            "Inserito da",
            "&nbsp;", 
            "&nbsp;", 
            "&nbsp;"
            )
        );
        
        $formSearch = new StatoCivileFormSearch();
        $formSearch->addSubmitButton();
        $formSearch->addCheckExpired();
        $formSearch->addYears($this->getYears());
        
        $paginatorRecords = $this->getRecordsPaginator();
        
        $this->setVariables(array(
            'paginator'     => $paginatorRecords,
            'tablesetter'   => 'stato-civile',
            'formSearch'    => $formSearch,
            'formExport'    => $formSearch
            )
        );

        $this->setRecords($this->getFormattedRecords($paginatorRecords));
        
        $this->setTemplate('datatable/datatable_statocivile.phtml');
    }
    
        /**
         * @return array|null
         */
        private function getYears()
        {
            $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager',1)) );
            $statoCivileGetterWrapper->setInput( array('fields'=>'DISTINCT(sca.anno) AS anno') );
            $statoCivileGetterWrapper->setupQueryBuilder();
            
            $years = $statoCivileGetterWrapper->getRecords();
            if ($years) {
                $yearsList = array();
                foreach($years as $year) {
                    $yearsList[$year['anno']] = $year['anno'];
                }
            }
            
            return $yearsList;
        }
        
        private function getSezioni()
        {
            
        }
        
        private function getSettori()
        {
            
        }
    
        /**
         * @return array 
         */
        private function getRecordsPaginator()
        {
            $param = $this->getInput('param', 1);

            $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager',1)) );
            $statoCivileGetterWrapper->setInput( array() );
            $statoCivileGetterWrapper->setupQueryBuilder();
            $statoCivileGetterWrapper->setupPaginator( $statoCivileGetterWrapper->setupQuery( $this->getInput('entityManager', 1) ) );
            $statoCivileGetterWrapper->setupPaginatorCurrentPage(isset($param['route']['page']) ? $param['route']['page'] : null);
            $statoCivileGetterWrapper->setupPaginatorItemsPerPage(isset($param['route']['perpage']) ? $param['route']['perpage'] : null);

            return $statoCivileGetterWrapper->getPaginator();
        }
        
        /**
         * 
         * @param type $records
         * @return boolean|array
         */
        private function getFormattedRecords($records)
        {
            if (!$records) {
                return false;
            }

            $recordsToReturn = array();
            foreach($records as $record) {
                $recordsToReturn[] = array(
                    $record['titolo'],
                    $record['progressivo'].' / '.$record['anno'],
                    $record['nome'],
                    $record['data'],
                    $record['scadenza'],
                    $record['user_name_surname'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/stato-civile/'.$record['id'],
                        'tooltip'   => 1,
                        'title'     => 'Modifica'
                    ),
                    array(
                        'type'      => 'attachButton',
                        'href'      => '#',
                        'tooltip'   => 1,
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
}
