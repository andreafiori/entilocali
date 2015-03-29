<?php

namespace Admin\Model\Users\Roles;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  28 February 2015
 */
class UsersRolesDataTable extends DataTableAbstract
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
            'tablesetter' => 'users-roles',
            'paginator'   => $paginatorRecords,
            'columns'     => array(
                "Nome",
                "Data inserimento",
                "Ultimo aggiornamento",
                "&nbsp;",
                "&nbsp;",
            ),
            ''
        ));

        $this->setTitle('Ruoli utente');

        $this->setDescription('Gestione ruoli utenti');
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
                        $row['name'],
                        $row['insertDate'],
                        $row['lastUpdate'],
                        ($row['name']=='WebMaster') ? '&nbsp;' :
                            array(
                                'type'      => 'updateButton',
                                'href'      => $this->getInput('baseUrl',1).'users/roles/permissions/'.$row['id'],
                                'data-id'   => $row['id'],
                                'title'     => 'Modifica ruolo utente'
                            ),
                        ($row['name']=='WebMaster') ? '&nbsp;' :
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'data-id'   => $row['id'],
                            'title'     => 'Elimina ruolo utente'
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

            $wrapper = new UsersRolesGetterWrapper(new UsersRolesGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array() );
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}