<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class StatoCivileSezioniDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->setTitle('Sezioni stato civile');
        $this->setDescription('Gestione sezioni stato civile');
        $this->setColumns( array(
            "Nome",
            "Data inserimento",
            "Data ultimo aggiornamento",
            "&nbsp;", 
            "&nbsp;",
            )
        );
        
        $paginatorRecords = $this->getRecordsPaginator();
        
        $this->setVariables(array(
                'paginator' => $paginatorRecords,
                'tablesetter' => 'stato-civile'
            )
        );
        
        $this->setRecords($this->getFormattedRecords($paginatorRecords));
        
        $this->setVariable('formBreadCrumbCategory', 'Stato civile');
        $this->setVariable('formBreadCrumbCategoryLink', $this->getInput('baseUrl', 1).'datatable/stato-civile');
    }
    
        /**
         * @return StatoCivileSezioniGetterWrapper
         */
        private function getRecordsPaginator()
        {
            $param = $this->getInput('param', 1);

            $objectWrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($this->getInput('entityManager',1)) );
            $objectWrapper->setInput( array() );
            $objectWrapper->setupQueryBuilder();
            $objectWrapper->setupPaginator( $objectWrapper->setupQuery( $this->getInput('entityManager', 1) ) );
            $objectWrapper->setupPaginatorCurrentPage(isset($param['route']['page']) ? $param['route']['page'] : null);
            $objectWrapper->setupPaginatorItemsPerPage(isset($param['route']['perpage']) ? $param['route']['perpage'] : null);

            return $objectWrapper->getPaginator();
        }
        
        /**
         * 
         * @param type $records
         * @return boolean
         */
        private function getFormattedRecords($records)
        {
            if (!$records) {
                return false;
            }

            $recordsToReturn = array();
            foreach($records as $record) {
                $recordsToReturn[] = array(
                    $record['nome'],
                    $record['dataInserimento'],
                    $record['dataUltimoAggiornamento'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/stato-civile-sezioni/'.$record['id'],
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
}

