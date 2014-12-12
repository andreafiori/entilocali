<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class ResponsabiliProcedimentoGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var \Admin\Model\ContrattiPubblici\ResposabiliProcedimentoGetter
     */
    protected $objectGetter;
    
    /**
     * @param \Admin\Model\ContrattiPubblici\ResposabiliProcedimentoGetter $resposabiliProcedimentoGetter
     */
    public function __construct(ResponsabiliProcedimentoGetter $resposabiliProcedimentoGetter)
    {
        $this->setObjectGetter($resposabiliProcedimentoGetter);
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