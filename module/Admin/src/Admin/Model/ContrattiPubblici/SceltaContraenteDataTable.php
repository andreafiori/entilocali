<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class SceltaContraenteDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariable('tablesetter', 'contratti-pubblici-scelta-contraente');
        $this->setVariable('paginator', $paginatorRecords);

        $this->setTitle('Contratti pubblici - scelta del contraente');
        $this->setDescription('Gestione scelta del contraente sui contratti pubblici');
        $this->setColumns(array(
                "Nome",
                "Stato",
                "&nbsp;", 
                "&nbsp;",
            )
        );
    }
    
        /**
         * @param type $records
         * @return type
         */
        private function formatRecordsToShowOnTable($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        $row['nomeScelta'],
                        $row['attivo'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici-scelta-contraente/'.$row['id'],
                            'title'     => 'Modifica'
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

        /**
         * @return array 
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $sceltaContraenteGetterWrapper = new SceltaContraenteGetterWrapper(new SceltaContraenteGetter($this->getInput('entityManager',1)) );
            $sceltaContraenteGetterWrapper->setInput( array() );
            $sceltaContraenteGetterWrapper->setupQueryBuilder();
            $sceltaContraenteGetterWrapper->setupPaginator( $sceltaContraenteGetterWrapper->setupQuery($this->getInput('entityManager', 1)) );
            $sceltaContraenteGetterWrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $sceltaContraenteGetterWrapper->setupRecords();
        }
}