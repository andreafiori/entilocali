<?php

namespace ModelModule\Model\Contacts;

use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 June 2014
 */
class ContactsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @param ContactsGetter $objectGetter
     */
    public function __construct(ContactsGetter $objectGetter)
    {
        $this->objectGetter = $objectGetter;
    }

    /**
     * @return null
     */
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
 
        $this->objectGetter->setSurname( $this->getInput('cognome', 1) );
        $this->objectGetter->setEmail( $this->getInput('email', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}

