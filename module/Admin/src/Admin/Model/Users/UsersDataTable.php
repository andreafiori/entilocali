<?php

namespace Admin\Model\Users;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
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
        $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager')) );
        $usersGetterWrapper->setInput( array() );
        $usersGetterWrapper->setupQueryBuilder();
        $usersGetterWrapper->getRecords();
        
        $records = $usersGetterWrapper->getRecords();
        
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['name'].' '.$record['surname'],
                $record['email'],
                $this->convertDateTimeToString($record['lastUpdate']),
                '',
                ucfirst($record['status']),
                array(
                    'type'      => 'updateButton',
                    'href'      => $this->getInput('baseUrl').'formdata/posts/'.$record['postid'],
                    'tooltip'   => 1,
                    'title'     => 'Modifica'
                ),
                array(
                    'type'      => 'deleteButton',
                    'tooltip'   => 1,
                    'title'     => 'Elimina',
                    'data-id'   => $record['postoptionid']
                ),
            );
        }
        
        return $recordsToReturn;
    }
}