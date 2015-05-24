<?php

namespace Admin\Model\Contenuti;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  11 January 2015
 */
class ContenutiGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**     
     * @var ContenutiGetter
     */
    protected $objectGetter;

    /**
     * @param ContenutiGetter $objectGetter
     */
    public function __construct(ContenutiGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    /**
     * @return null
     */
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setSottosezione( $this->getInput('sottosezione', 1) );
        $this->objectGetter->setNumero( $this->getInput('numero', 1) );
        $this->objectGetter->setAnno( $this->getInput('anno', 1) );
        $this->objectGetter->setModulo( $this->getInput('modulo', 1) );
        $this->objectGetter->setNoScaduti( $this->getInput('noscaduti', 1) );
        $this->objectGetter->setAttivo( $this->getInput('attivo', 1) );
        $this->objectGetter->setUtente( $this->getInput('utente', 1) );
        $this->objectGetter->setIsAmmTrasparente( $this->getInput('isAmmTrasparente', 1) );
        $this->objectGetter->setExcludeSezioneId( $this->getInput('excludeSezioneId', 1) );
        $this->objectGetter->setExcludeSottoSezioneId( $this->getInput('excludeSottoSezioneId', 1) );
        $this->objectGetter->setSezioneId( $this->getInput('sezioneId', 1) );
        $this->objectGetter->setShowToAll( $this->getInput('showToAll', 1) );
        $this->objectGetter->setLingua( $this->getInput('lingua', 1) );
        $this->objectGetter->setLanguageAbbreviation( $this->getInput('languageAbbreviation', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}
