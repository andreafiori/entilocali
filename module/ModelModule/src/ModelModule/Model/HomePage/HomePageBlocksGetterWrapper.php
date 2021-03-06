<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class HomePageBlocksGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var HomePageBlocksGetter
     */
    protected $objectGetter;

    /**
     * @param HomePageBlocksGetter $objectGetter
     */
    public function __construct(HomePageBlocksGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId($this->getInput('id', 1));
        $this->objectGetter->setModuleId($this->getInput('moduleId', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }
}
