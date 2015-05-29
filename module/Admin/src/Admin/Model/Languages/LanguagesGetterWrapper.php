<?php

namespace Admin\Model\Languages;

use Application\Model\RecordsGetterWrapperAbstract;

class LanguagesGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var LanguagesGetter
     */
    protected $objectGetter;

    /**
     * @param LanguagesGetter $objectGetter
     */
    public function __construct(LanguagesGetter $objectGetter)
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

        $this->objectGetter->setId($this->getInput('id', 1));
        $this->objectGetter->setAbbreviation1($this->getInput('abbrev1', 1));
        $this->objectGetter->setStatus($this->getInput('status', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));

        return null;
    }
}