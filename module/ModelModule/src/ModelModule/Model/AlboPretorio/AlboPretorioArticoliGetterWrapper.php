<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class AlboPretorioArticoliGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var AlboPretorioArticoliGetter
     */
    protected $objectGetter;

    /**
     * @param AlboPretorioArticoliGetter $objectGetter
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
        $this->objectGetter->setMese($this->getInput('mese', 1));
        $this->objectGetter->setAnno($this->getInput('anno', 1));
        $this->objectGetter->setDataScadenza($this->getInput('dataScadenza', 1));
        $this->objectGetter->setSezioneId($this->getInput('sezioneId', 1));
        $this->objectGetter->setUtenteId($this->getInput('utenteId', 1));
        $this->objectGetter->setAnnullato($this->getInput('annullato', 1));
        $this->objectGetter->setPubblicare($this->getInput('pubblicare', 1));
        $this->objectGetter->setAttivo($this->getInput('attivo', 1));
        $this->objectGetter->setNoScaduti($this->getInput('noScaduti', 1));
        $this->objectGetter->setFreeSearch($this->getInput('freeSearch', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }
}
