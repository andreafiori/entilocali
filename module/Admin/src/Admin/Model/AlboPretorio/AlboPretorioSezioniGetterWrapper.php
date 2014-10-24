<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  24 July 2014
 */
class AlboPretorioSezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\AlboPretorio\SezioniGetter **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\AlboPretorio\AlboPretorioSezioniGetter $objectGetter
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
    }
}
