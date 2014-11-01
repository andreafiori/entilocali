<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  08 July 2014
 */
class AlboPretorioArticoliGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\AlboPretorio\AlboPretorioArticoliGetter **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\AlboPretorio\AlboPretorioArticoliGetter $objectGetter
     */
    public function __construct(AlboPretorioArticoliGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();        
        $this->objectGetter->setId($this->getInput('id', 1));
        $this->objectGetter->setNumeroProgressivo($this->getInput('numeroProgressivo', 1));
        $this->objectGetter->setNumeroAtto($this->getInput('numeroAtto', 1));
        $this->objectGetter->setAnno($this->getInput('anno', 1));
        $this->objectGetter->setDataScadenza($this->getInput('dataScadenza', 1));
        $this->objectGetter->setSezioneId($this->getInput('sezioneId', 1));
        $this->objectGetter->setUtenteId($this->getInput('utenteId', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }
}
