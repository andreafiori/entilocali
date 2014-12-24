<?php

namespace Admin\Model\Entiterzi;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiterziDataTable extends DataTableAbstract
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
                'tablesetter' => 'enti-terzi',
                'paginator'   => $paginatorRecords,
                'columns'     => array(
                                    "Nome",
                                    "Email",
                                    "&nbsp;", 
                                    "&nbsp;",
                                ),
                ''
        ));

        $this->setTitle('Rubrica enti terzi');
        $this->setDescription('Gestione rubrica contatti enti terzi');
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
                        $row['nome'],
                        $row['email'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/enti-terzi/'.$row['id'],
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina'
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

            $wrapper = new EntiTerziGetterWrapper(new EntiTerziGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('orderBy' => 'ret.id DESC') );
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}