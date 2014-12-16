<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessionSezioniDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getParam();
        
        $paginatorRecords = $this->setupPaginatorRecords(isset($param['route']['page']) ? $param['route']['page'] : null);
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setTitle('Settori atti di concessione');
        $this->setDescription('Gestione settori atti di concessione');
        $this->setColumns(array(
                "Nome",
                "Responsabile",
                "",
                "",
            )
        );
        
        $this->setVariables(array(
                'tablesetter' => 'atti-concessione',
                'paginator' => $paginatorRecords
            )
        );
        
        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessun bando di contratto presente');
            $this->setVariable('messageDescription', 'Nessun articolo o bando di contratto presente in archivio');
        }
    }
    
        /**
         * @return array
         */
        private function setupPaginatorRecords($currentPage)
        {
            $wrapper = new AttiConcessioneSezioniGetterWrapper(new AttiConcessioneSezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput(array());
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage($currentPage);

            return $wrapper->setupRecords();
        }
        
        /**
         * @param array $records
         * @return array
         */
        private function getFormattedDataTableRecords($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        $row['nome'],
                        $row['responsabile'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici/'.$row['id'],
                            'title'     => 'Elimina',
                            'data-id'   => $row['id']
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}