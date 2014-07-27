<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;

/**
 * @author Andrea Fiori
 * @since  24 July 2014
 */
class AlboPretorioSezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\AlboPretorio\AlboPretorioSezioniGetter **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\AlboPretorio\AlboPretorioSezioniGetter $alboPretorioSezioniGetter
     */
    public function __construct(AlboPretorioSezioniGetter $alboPretorioSezioniGetter)
    {
        $this->setObjectGetter($alboPretorioSezioniGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
    }
}

