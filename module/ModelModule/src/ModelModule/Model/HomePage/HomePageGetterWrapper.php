<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class HomePageGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var HomePageGetter
     */
    protected $objectGetter;

    /**
     * @param HomePageGetter $objectGetter
     */
    public function __construct(HomePageGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId($this->getInput('id', 1));
        $this->objectGetter->setLanguage($this->getInput('language', 1));
        $this->objectGetter->setLanguageAbbreviation($this->getInput('languageAbbreviation', 1));
        $this->objectGetter->setModuleCode($this->getInput('moduleCode', 1));
        $this->objectGetter->setOnlyActiveModules($this->getInput('onlyActiveModules', 1));
        $this->objectGetter->setReferenceId($this->getInput('referenceId', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }

    /**
     * Regroup records per module code
     *
     * @param array $records
     * @return array
     */
    public function formatPerModuleCode(array $records)
    {
        $recordsToReturn = array();

        foreach($records as $record) {
            if ( isset($record['moduleCode']) ) {
                $recordsToReturn[$record['moduleCode']][] = $record;
            }
        }

        return $recordsToReturn;
    }
}
