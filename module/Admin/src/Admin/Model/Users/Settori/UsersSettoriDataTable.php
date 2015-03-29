<?php

namespace Admin\Model\Users\Settori;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  26 March 2015
 */
class UsersSettoriDataTable extends DataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $paginatorRecords = $this->setupPaginatorRecords();

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariables(array(
            'tablesetter' => 'users',
            'paginator'   => $paginatorRecords,
            'columns'     => array(
                "Nome",
                "Responsabile",
                "&nbsp;",
                "&nbsp;",
            ),
            ''
        ));

        $this->setTitle('Settori utenti');

        $this->setDescription('Gestione settori utenti');
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
                        $row['nome'],
                        $row['name'].' '.$row['surname'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/users-settori/'.$row['id'],
                            'title'     => 'Modifica settore utente'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'title'     => 'Elimina settore utente',
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

            $wrapper = new UsersSettoriGetterWrapper(new UsersSettoriGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}