<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\DataTable\DataTableAbstract;

class OperatoriDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $paginatorRecords = $this->setupPaginatorRecords();
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setVariable('tablesetter', 'contratti-pubblici-operatori');
        $this->setVariable('paginator', $paginatorRecords);

        $this->setTitle('Operatori contratti pubblici');
        $this->setDescription('Gestione operatori contratti pubblici');
        $this->setColumns(array(
                "CF",
                "Ragione sociale",
                "Nome",
                "Ruolo",
                "&nbsp;", 
                "&nbsp;",
            )
        );
        
        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessun operatore presente');
            $this->setVariable('messageDescription', 'Nessun articolo o bando di contratto presente in archivio');
        }
        
    }
    
        /**
         * @return array
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $wrapper = new OperatoriGetterWrapper(new OperatoriGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($this->getInput());
            $wrapper->setupQueryBuilder(); 
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

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
                        $row['cf'],
                        $row['ragioneSociale'],
                        $row['nome'],
                        $row['ruolo1'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici-operatori/'.$row['id'],
                            'tooltip'   => 1,
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici-operatori/'.$row['id'],
                            'title'     => 'Elimina',
                            'data-id'   => $row['id']
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}
