<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class OperatoriAggiudicatariGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var OperatoriAggiudicatariGetter
     */
    protected $objectGetter;

    /**
     * @param OperatoriAggiudicatariGetter $objectGetter
     */
    public function __construct(OperatoriAggiudicatariGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setContrattoId( $this->getInput('contrattoId', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}
