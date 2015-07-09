<?php

namespace ModelModule\Model\Users\Roles;

use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var UsersRolesPermissionsGetter
     */
    protected $objectGetter;

    /**
     * @param UsersRolesPermissionsGetter $objectGetter
     */
    public function __construct(UsersRolesPermissionsGetter $objectGetter)
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
     * @return array
     */
    public function sortPerGroup(array $records)
    {
        $toReturn = array();
        foreach($records as $record) {
            $toReturn[isset($record['group']) ? $record['group'] : null][] = $record;
        }

        return $toReturn;
    }
}