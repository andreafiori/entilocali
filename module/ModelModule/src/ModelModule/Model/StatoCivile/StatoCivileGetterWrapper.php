<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class StatoCivileGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var StatoCivileGetter
     */
    protected $objectGetter;

    /**
     * @param StatoCivileGetter $statoCivileGetter
     */
    public function __construct(StatoCivileGetter $statoCivileGetter)
    {
        $this->setObjectGetter($statoCivileGetter);
    }

    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setProgressivo( $this->getInput('progressivo', 1) );
        $this->objectGetter->setMese( $this->getInput('mese', 1) );
        $this->objectGetter->setAnno( $this->getInput('anno', 1) );
        $this->objectGetter->setSezioneId( $this->getInput('sezioneId', 1) );
        $this->objectGetter->setNoScaduti($this->getInput('noScaduti', 1));
        $this->objectGetter->setAttivo($this->getInput('attivo', 1));
        $this->objectGetter->setTextSearch( $this->getInput('textSearch', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }

    /**
     * @param $years
     * @return array
     */
    public function formatYears($years)
    {
        if (empty($years)) {
            return $years;
        }

        $yearsList = array();
        foreach($years as $year) {
            if (isset($year['anno'])) {
                $yearsList[$year['anno']] = $year['anno'];
            }
        }

        return $yearsList;
    }
}