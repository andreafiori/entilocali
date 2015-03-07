<?php

namespace Admin\Model\ContrattiPubblici\Settori;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * Settori contratti pubblici datatable
 *
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class SettoriDataTable extends DataTableAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $paginatorRecords = $this->setupPaginatorRecords(array(
            'orderBy' => 'cs.id DESC'
        ));

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariables(array(
                'tablesetter'   => 'contratti-pubblici-settori',
                'paginator'     => $paginatorRecords,
            )
        );

        $this->setTitle('Settori contratti pubblici');
        $this->setDescription('Gestione settori contratti pubblici');
        $this->setColumns(array(
                "Nome",
                "Responsabile",
                "&nbsp;", 
                "&nbsp;",
            )
        );
    }

        /**
         * @param $records
         * @return array
         */
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
                            'href'      => $this->getInput('baseUrl',1).'formdata/contratti-pubblici-settori/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'title'     => 'Modifica',
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
        private function setupPaginatorRecords($input = array())
        {
            $param = $this->getParam();

            $wrapper = new SettoriGetterWrapper(new SettoriGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}