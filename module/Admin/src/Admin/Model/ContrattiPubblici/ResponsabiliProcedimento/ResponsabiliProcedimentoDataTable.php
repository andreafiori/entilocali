<?php

namespace Admin\Model\ContrattiPubblici\ResponsabiliProcedimento;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class ResponsabiliProcedimentoDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $paginatorRecords = $this->setupPaginatorRecords();
        
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setVariable('tablesetter', 'contratti-pubblici-responsabili');
        $this->setVariable('paginator', $paginatorRecords);

        $this->setTitle('Contratti pubblici: responsabili procedimenti');
        $this->setDescription('Gestione responsabile di procedimento contratti pubblici');
        $this->setColumns(array(
                "Nome",
                "&nbsp;", 
                "&nbsp;",
            )
        );
        
        if (!$this->getRecords()) {
            $this->setVariable('messageTitle', 'Nessun responsabile procedimento in archivio');
            $this->setVariable('messageDescription', 'Nessun nome responsabile procedimento in archivio');
        }
    }

        /**
         * @return array 
         */
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $contrattiPubbliciGetterWrapper = new ResponsabiliProcedimentoGetterWrapper(new ResponsabiliProcedimentoGetter($this->getInput('entityManager',1)) );
            $contrattiPubbliciGetterWrapper->setInput(array('orderBy'=>'crp.id DESC'));
            $contrattiPubbliciGetterWrapper->setupQueryBuilder(); 
            $contrattiPubbliciGetterWrapper->setupPaginator( $contrattiPubbliciGetterWrapper->setupQuery($this->getInput('entityManager', 1)) );
            $contrattiPubbliciGetterWrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $contrattiPubbliciGetterWrapper->setupRecords();
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
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici-responsabili/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici-responsabili/'.$row['id'],
                            'title'     => 'Elimina',
                            'data-id'   => $row['id']
                        ),
                    );
                }
            }
            return $arrayToReturn;
        }
}
