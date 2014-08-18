<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class SettoriDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariables(array(
                'tablesetter' => 'contratti-pubblici-scelta-settori',
                'paginator' => $paginatorRecords,
            )
        );

        $this->setTitle('Settori contratti pubblici');
        $this->setDescription('Gestione settori contratti pubblici');
        $this->setColumns(array(
                "Nome scelta",
                "Stato",
                "&nbsp;", 
                "&nbsp;",
            )
        );
    }
    
        private function formatRecordsToShowOnTable($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        $row['nome'],
                        $row['responsabile'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici-scelta-contraente/'.$row['id'],
                            'tooltip'   => 1,
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'tooltip'   => 1,
                            'title'     => 'Modifica'
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

            $objectWrapper = new SettoriGetterWrapper(new SettoriGetter($this->getInput('entityManager',1)) );
            $objectWrapper->setInput( array() );
            $objectWrapper->setupQueryBuilder();
            $objectWrapper->setupPaginator( $objectWrapper->setupQuery($this->getInput('entityManager', 1)) );
            $objectWrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $objectWrapper->setupRecords();
        }
}