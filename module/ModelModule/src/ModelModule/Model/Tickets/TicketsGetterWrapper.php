<?php

namespace ModelModule\Model\Tickets;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class TicketsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var TicketsGetter
     */
    protected $objectGetter;

    /**
     * @param TicketsGetter $ticketsGetter
     */
    public function __construct(TicketsGetter $ticketsGetter)
    {
        $this->setObjectGetter($ticketsGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('grouoBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}
