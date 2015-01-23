<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class ContrattiPubbliciGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var \Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter
     */
    protected $objectGetter;
    
    public function __construct(ContrattiPubbliciGetter $contrattiPubbliciGetter)
    {
        $this->setObjectGetter($contrattiPubbliciGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * Add lista partecipanti and aggiudicatario
     * 
     * @param array $records
     */
    public function addListaPartecipanti(array $records)
    {        
        foreach($records as &$record) {
            $wrapper = '';
            
            $record['partecipanti'][] = array();
        }
    }

    /**
     * @param array $records
     */
    public function addAttachments(array $records)
    {
        // TODO: add attachments to records array
    }
}
