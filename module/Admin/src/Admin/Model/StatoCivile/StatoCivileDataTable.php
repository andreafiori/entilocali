<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;

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
        $this->setDescription('Gestione atti stato civile in archivio');
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
        
        $paginatorRecords = $this->getRecordsPaginator();
        
        $this->setVariable('paginator', $paginatorRecords);
        $this->setRecords($this->getFormattedRecords($paginatorRecords));

        $this->setVariable('tablesetter', 'stato-civile');
        $this->setTemplate('datatable/datatable_statocivile.phtml');
    }

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
                    '',
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
                        'href'      => '#',
                        'tooltip'   => 1,
                        'title'     => 'Modifica'
                    ),
                );
            }

            return $recordsToReturn;
        }
}
