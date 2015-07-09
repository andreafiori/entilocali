<?php

namespace ModelModule\Model\Sezioni;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class SottoSezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var SottoSezioniGetter
     */
    protected $objectGetter;

    /**
     * @param SottoSezioniGetter $objectGetter
     */
    public function __construct(SottoSezioniGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setExcludeId( $this->getInput('excludeId', 1) );
        $this->objectGetter->setExcludeSezioneId( $this->getInput('excludeSezioneId', 1) );
        $this->objectGetter->setSlug( $this->getInput('slug', 1) );
        $this->objectGetter->setIsSs( $this->getInput('isSs', 1) );
        $this->objectGetter->setSezioneId( $this->getInput('sezioneId', 1) );
        $this->objectGetter->setProfonditaDa( $this->getInput('profonditaDa', 1) );
        $this->objectGetter->setProfonditaDaAsNull( $this->getInput('profonditaDaAsNull', 1) );
        $this->objectGetter->setModulo( $this->getInput('modulo', 1) );
        $this->objectGetter->setLinguaId( $this->getInput('linguaId', 1) );
        $this->objectGetter->setLanguageAbbreviation( $this->getInput('languageAbbreviation', 1) );
        $this->objectGetter->setAttivo( $this->getInput('attivo', 1) );
        $this->objectGetter->setIsAmmTrasparente( $this->getInput('isAmmTrasparente', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}
