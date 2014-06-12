<?php

namespace Admin\Model\Contacts;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\Contacts\ContactsGetter;

/**
 * @author Andrea Fiori
 * @since  10 June 2014
 */
class ContactsGetterWrapper extends RecordsGetterWrapperAbstract
{
    private $contactsGetter;

    /**
     * @param \Admin\Model\Contacts\ContactsGetter $contattiGetter
     */
    public function __construct(ContactsGetter $contattiGetter)
    {
        $this->contactsGetter = $contattiGetter;
    }
    
    public function setupQueryBuilder()
    {
        $this->contactsGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->contactsGetter->setMainQuery();
 
        $this->contactsGetter->setSurname( $this->getInput('cognome', 1) );
        $this->contactsGetter->setEmail( $this->getInput('email', 1) );        
        $this->contactsGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->contactsGetter->getQueryResult();
    }
    
    /**
     * @return type
     */
    public function getContactsGetter()
    {
        return $this->contactsGetter;
    }
}

