<?php

namespace Admin\Model\Contacts;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 June 2014
 */
class ContactsGetterWrapper extends RecordsGetterWrapperAbstract
{
    private $contactsGetter;

    /**
     * @param ContactsGetter $objectGetter
     */
    public function __construct(ContactsGetter $objectGetter)
    {
        $this->contactsGetter = $objectGetter;
    }

    /**
     * @return null
     */
    public function setupQueryBuilder()
    {
        $this->contactsGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->contactsGetter->setMainQuery();
 
        $this->contactsGetter->setSurname( $this->getInput('cognome', 1) );
        $this->contactsGetter->setEmail( $this->getInput('email', 1) );        
        $this->contactsGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
    
    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->contactsGetter->getQueryResult();
    }
    
    /**
     * @return ContactsGetter
     */
    public function getContactsGetter()
    {
        return $this->contactsGetter;
    }
}

