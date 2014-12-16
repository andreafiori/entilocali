<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessioneRespProcDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $paginatorRecords = $this->setupPaginatorRecords();
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setTitle('Responsabili di procedimento atti di concessione');
        $this->setDescription('Gestione responsabili di procedimento atti di concessione');
        $this->setColumns(array(
                "Nome",
                "Stato",
                "",
                "",
            )
        );
        
        $this->setVariables(array(
                'tablesetter' => 'atti-concessione-resp',
                'paginator' => $paginatorRecords
            )
        );

        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessun responsabile di procedimento');
            $this->setVariable('messageDescription', 'Nessun responsabile di procedimento per gli atti di concessione presente in archivio');
        }
    }
    
        /**
         * @return array
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $wrapper = new AttiConcessioneRespProcGetterWrapper(new AttiConcessioneRespProcGetter($this->getInput('entityManager',1)) );
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
                        $row['nomeResp'],
                        isset($row['attivo']) ? 'Attivo' : 'Disattivato',
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/atti-concessione-resp/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/atti-concessione-resp/'.$row['id'],
                            'title'     => 'Elimina responsabile procedimento',
                            'data-id'   => $row['id']
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}
