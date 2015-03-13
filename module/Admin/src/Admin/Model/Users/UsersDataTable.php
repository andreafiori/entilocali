<?php

namespace Admin\Model\Users;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  15 June 2014
 */
class UsersDataTable extends DataTableAbstract
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
                "Nome e Cognome",
                "Email",
                "Ultima modifica",
                "Ultima modifica password",
                //"Stato",
                "Ruolo",
                "&nbsp;",
                "&nbsp;",
            ),
            ''
        ));

        $this->setTitle('Utenti');
        $this->setDescription('Gestione utenti');
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
                    '<a href="mailto:'.$row['email'].'" title="Scrivi a '.$row['name'].' '.$row['surname'].'">'.$row['email'].'</a>',
                    $row['lastUpdate'],
                    $row['passwordLastUpdate'],
                    //$row['status'],
                    $row['roleName'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/users/'.$row['id'],
                        'title'     => 'Modifica utente'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'title'     => 'Elimina utente',
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
        private function setupPaginatorRecords()
        {
            $param = $this->getParam();

            $wrapper = new UsersGetterWrapper(new UsersGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('orderBy' => 'u.id DESC') );
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery($this->getInput('entityManager', 1)) );
            $wrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

            return $wrapper->setupRecords();
        }
}