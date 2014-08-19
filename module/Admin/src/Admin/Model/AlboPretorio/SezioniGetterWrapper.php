<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;

/**
 * @author Andrea Fiori
 * @since  24 July 2014
 */
class SezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\AlboPretorio\SezioniGetter **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\AlboPretorio\SezioniGetter $sezioniGetter
     */
    public function __construct(SezioniGetter $sezioniGetter)
    {
        $this->setObjectGetter($sezioniGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
    }
}
