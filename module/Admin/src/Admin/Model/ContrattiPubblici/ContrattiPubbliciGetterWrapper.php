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
     * @var ContrattiPubbliciGetter
     */
    protected $objectGetter;

    /**
     * @param ContrattiPubbliciGetter $objectGetter
     */
    public function __construct(ContrattiPubbliciGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
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
     * TODO: Add lista partecipanti and aggiudicatario
     * 
     * @param array $records
     */
    public function addListaPartecipanti(array $records)
    {
        foreach($records as &$record) {

            $record['partecipanti'][] = array();
        }
    }

    /**
     * TODO: add attachment files selection
     *
     * @param array $records
     */
    public function addAttachments(array $records)
    {
        // TODO: add attachments to records array
    }
}
