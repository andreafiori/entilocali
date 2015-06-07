<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class AlboPretorioSezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var AlboPretorioSezioniGetter
     */
    protected $objectGetter;

    /**
     * @param AlboPretorioSezioniGetter $objectGetter
     */
    public function __construct(AlboPretorioSezioniGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}
