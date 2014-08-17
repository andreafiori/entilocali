<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class ResposabiliProcedimentoGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var  \Admin\Model\ContrattiPubblici\ResposabiliProcedimentoGetter **/
    protected $objectGetter;
    
    /**
     * @param \Admin\Model\ContrattiPubblici\ResposabiliProcedimentoGetter $resposabiliProcedimentoGetterr
     */
    public function __construct(ResposabiliProcedimentoGetter $resposabiliProcedimentoGetterr)
    {
        $this->setObjectGetter($resposabiliProcedimentoGetterr);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}