<?php

namespace ModelModule\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriAggiudicatariGetterWrapper;
use ModelModule\Model\RecordsGetterWrapperAbstract;

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
        $this->objectGetter->setUserId( $this->getInput('userId', 1) );
        $this->objectGetter->setScaduti( $this->getInput('scaduti', 1) );
        $this->objectGetter->setNoScaduti( $this->getInput('noScaduti', 1) );
        $this->objectGetter->setFreeSearch( $this->getInput('freeSearch', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }

    /**
     * Add lista partecipanti
     *
     * @param mixed $records
     * @return mixed
     */
    public function addListaPartecipanti($records)
    {
        $this->assertOperatoriAggiudicatariGetterWrapper();

        $em = $this->getEntityManager();

        foreach($records as &$record) {

            $wrapper = new OperatoriAggiudicatariGetterWrapper(new OperatoriAggiudicatariGetter($em));
            $wrapper->setInput(array(
                'contrattoId' => $record['id'],
            ));
            $wrapper->setupQueryBuilder();

            $operatoriRecords = $wrapper->getRecords();

            if (!empty($operatoriRecords)) {

                foreach($operatoriRecords as $operatore) {

                    if (isset($operatore['aggiudicatario']) and $operatore['aggiudicatario']==1) {
                        $record['operatori-aggiudicatari'][] = $operatore;
                    } else {
                        $record['operatori'][] = $operatore;
                    }

                }

            }
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
                    new OperatoriAggiudicatariGetter($this->getEntityManager())
                );
            }

            return $this->operatoriAggiudicatariGetterWrapper;
        }
}
