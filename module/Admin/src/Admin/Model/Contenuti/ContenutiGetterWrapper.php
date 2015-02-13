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
    
    public function __construct(ContenutiGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
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
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}