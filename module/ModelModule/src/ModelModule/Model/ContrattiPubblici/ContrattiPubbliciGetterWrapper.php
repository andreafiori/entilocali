<?php

namespace ModelModule\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetterWrapper;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetterWrapper;
use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class ContrattiPubbliciGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var OperatoriAggiudicatariGetterWrapper
     */
    private $operatoriAggiudicatariGetterWrapper;

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
     * @param array $records
     */
    public function addListaPartecipanti(array $records)
    {
        $this->assertOperatoriAggiudicatariGetterWrapper();

        foreach($records as &$record) {

            $this->operatoriAggiudicatariGetterWrapper->setInput(array(
                'contrattoId' => $record['id'],
            ));

            $record['operatori'][] = $this->operatoriAggiudicatariGetterWrapper->getRecords();
            $record['aggiudicatario'][] = array();
        }

        return $records;
    }

    /**
     * @param OperatoriAggiudicatariGetterWrapper $operatoriAggiudicatariGetterWrapper
     */
    public function setOperatoriAggiudicatariGetterWrapper(OperatoriAggiudicatariGetterWrapper $operatoriAggiudicatariGetterWrapper)
    {
        $this->operatoriAggiudicatariGetterWrapper = $operatoriAggiudicatariGetterWrapper;
    }

    /**
     * @return OperatoriAggiudicatariGetterWrapper
     */
    public function getOperatoriAggiudicatariGetterWrapper()
    {
        return $this->operatoriAggiudicatariGetterWrapper;
    }

        /**
         * @return OperatoriAggiudicatariGetterWrapper
         */
        private function assertOperatoriAggiudicatariGetterWrapper()
        {
            if (!$this->operatoriAggiudicatariGetterWrapper) {
                $this->operatoriAggiudicatariGetterWrapper = new OperatoriAggiudicatariGetterWrapper(
                    new OperatoriAggiudicatariGetter($this->getInput('entityManager',1))
                );
            }

            return $this->operatoriAggiudicatariGetterWrapper;
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
