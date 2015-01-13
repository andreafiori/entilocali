<?php

namespace Admin\Model\Sezioni;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\Sezioni\SottoSezioniGetter;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SottoSezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var SottoSezioniGetter **/
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
        $this->objectGetter->setSlug( $this->getInput('slug', 1) );
        $this->objectGetter->setIsSs( $this->getInput('isSs', 1) );
        $this->objectGetter->setSezioneId( $this->getInput('sezioneId', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}
