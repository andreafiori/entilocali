<?php

namespace Admin\Model\HomePage;

use Application\Model\RecordsGetterWrapperAbstract;

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
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }
}
