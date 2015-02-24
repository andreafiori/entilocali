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
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->title       = 'Utenti';
        $this->description = 'Gestione elenco utenti';
    }
    
    /**
     * @return array 
     */
    public function getColumns()
    {
        return array("Nome e cognome", "Email", "Ultima modifica", "Stato", "Ruolo", "&nbsp;", "&nbsp;");
    }
    
    /**
     * @return array 
     */
    public function getRecords()
    {
        return $this->getDataTableRowsFromUserRecords( $this->getUserRecords(new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager')) )) );
    }
    
        /**
         * @param \Admin\Model\Users\UsersGetterWrapper $usersGetterWrapper
         */
        public function getUserRecords(UsersGetterWrapper $usersGetterWrapper)
        {
            $usersGetterWrapper->setInput( array() );
            $usersGetterWrapper->setupQueryBuilder();
            
            return $usersGetterWrapper->getRecords();
        }
        
        /**
         * @param array $records
         * @return array or boolean
         */
        private function getDataTableRowsFromUserRecords($records)
        {
            if (!is_array($records)) {
                return false;
            }
            
            $recordsToReturn = array();
            foreach($records as $record) {
                
                if (!isset($record['name'])) {
                    continue;
                }
                
                $recordsToReturn[] = array(
                    $record['name'].' '.$record['surname'],
                    '<a href="mailto:'.$record['email'].'" title="Scrivi a '.$record['name'].' '.$record['surname'].'">'.$record['email'].'</a>',
                    $this->convertDateTimeToString($record['lastUpdate']),
                    ucfirst($record['status']),
                    '',
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/users/'.$record['id'],
                        'title'     => 'Modifica utente'
                    ),
                    array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'title'     => 'Elimina utente',
                        'data-id'   => $record['id']
                    ),
                );
            }
            
            return $recordsToReturn;
        }
}