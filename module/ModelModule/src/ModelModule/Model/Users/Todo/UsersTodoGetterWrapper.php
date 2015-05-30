<?php

namespace ModelModule\Model\Users\Todo;

use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  26 March 2015
 */
class UsersTodoGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var UsersTodoGetter
     */
    protected $objectGetter;

    /**
     * @param UsersTodoGetter $objectGetter
     */
    public function __construct(UsersTodoGetter $objectGetter)
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
}