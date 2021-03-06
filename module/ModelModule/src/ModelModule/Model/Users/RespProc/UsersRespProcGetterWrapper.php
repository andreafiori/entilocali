<?php

namespace ModelModule\Model\Users\RespProc;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class UsersRespProcGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var UsersRespProcGetter
     */
    protected $objectGetter;

    /**
     * @param UsersRespProcGetter $objectGetter
     */
    public function __construct(UsersRespProcGetter $objectGetter)
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
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}