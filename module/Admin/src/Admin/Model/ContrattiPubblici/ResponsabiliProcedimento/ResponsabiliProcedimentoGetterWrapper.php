<?php

namespace Admin\Model\ContrattiPubblici\ResponsabiliProcedimento;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class ResponsabiliProcedimentoGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var ResposabiliProcedimentoGetter
     */
    protected $objectGetter;
    
    /**
     * @param ResposabiliProcedimentoGetter $objectGetter
     */
    public function __construct(ResponsabiliProcedimentoGetter $objectGetter)
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
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}