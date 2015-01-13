<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessioneSettoriDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $paginatorRecords = $this->setupPaginatorRecords();
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setTitle('Settori atti di concessione');
        $this->setDescription('Gestione settori atti di concessione');
        $this->setColumns(array(
                "Nome",
                "Responsabile",
                "",
                ""
            )
        );
        
        $this->setVariables(array(
                'tablesetter' => 'atti-concessione-settori',
                'paginator' => $paginatorRecords
            )
        );
        
        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessuna sezione atti di concessione');
            $this->setVariable('messageDescription', 'Nessuna sezione atti di concessione presente in archivio');
        }
    }
    
        /**
         * @return array
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $wrapper = new AttiConcessioneSettoriGetterWrapper(new AttiConcessioneSettoriGetter($this->getInput('entityManager',1)) );
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
                        $row['nome'],
                        $row['responsabile'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/atti-concessione-settori/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/atti-concessione-settori/'.$row['id'],
                            'title'     => 'Elimina',
                            'data-id'   => $row['id']
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}
