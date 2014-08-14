<?php

namespace Admin\Model\Tickets;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since 01 August 2014
 */
class TicketsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\Tickets\TicketsGetter **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\Tickets\TicketsGetter $ticketsGetter
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
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}
