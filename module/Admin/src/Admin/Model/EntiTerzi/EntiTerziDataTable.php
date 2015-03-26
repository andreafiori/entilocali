<?php

namespace Admin\Model\EntiTerzi;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiTerziDataTable extends DataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getInput('param',1);

        if (isset($param['post']['deleteId'])) {
            $crudHandler = new EntiTerziCrudHandler();
            $crudHandler->setConnection($this->getInput('entityManager')->getConnection());
            $crudHandler->setUserDetails($this->getUserDetails());
            $crudHandler->delete($param['post']['deleteId']);
        }

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
         * @param mixed $records
         * @return array
         */
        private function formatRecordsToShowOnTable($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {

                    $arrayToReturn[] = array(
                        array(
                            'type' => 'field',
                            'record' => $row['nome'],
                            'class' => '',
                        ),
                        array(
                            'type' => 'field',
                            'record' => $row['email'],
                            'class' => '',
                        ),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/enti-terzi/'.$row['id'],
                            'title'     => 'Modifica ente terzo',
                            'class' => '',
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina ente terzo',
                            'class' => '',
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
