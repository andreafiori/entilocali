<?php

namespace Admin\Model\Contacts;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\Contacts\ContactsGetter;
use Admin\Model\Contacts\ContactsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  10 June 2014
 */
class ContactsDataTable extends DataTableAbstract implements DataTableInterface
{
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getColumns()
    {
        return array("Nome e cognome", "Email", "Data invio", "&nbsp;");
    }
    
    public function getRecords()
    {
        $param = $this->getInput('param', 1);

        $this->title        = 'Contatti';
        $this->description  = 'Elenco messaggi ricevuto dal modulo contatti';
        
        $contactsGetterWrapper = new ContactsGetterWrapper( new ContactsGetter($this->getInput('entityManager',1)) );
        
        $contactsGetterWrapper->setupQueryBuilder();      
        
        return $this->buildDataTableRows( $contactsGetterWrapper->getRecords() );
    }
    
        /**
         * @param array $records
         * @return array
         */
        private function buildDataTableRows($records)
        {
            if (empty($records)) {
                return false;
            }
            
            $recordsToReturn = array();
            foreach($records as $record) {
                $recordsToReturn[] = array(
                    $record['name'].' '.$record['surname'],
                    $record['email'],
                    $this->convertDateTimeToString($record['insertDate']),
                    array(
                        'type'      => 'deleteButton',
                        'tooltip'   => 1,
                        'title'     => 'Elimina',
                        'data-id'   => $record['id']
                    ),
                );
            }
            
            return $recordsToReturn;
        }
}
