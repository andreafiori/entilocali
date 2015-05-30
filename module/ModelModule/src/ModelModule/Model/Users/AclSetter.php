<?php

namespace ModelModule\Model\Users;

use ModelModule\Model\NullException;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

/**
 * @author Andrea Fiori
 * @since  05 March 2015
 */
class AclSetter
{
    private $acl;

    /**
     * @var Roles\UsersRolesGetterWrapper
     */
    private $usersRolesGetterWrapper;

    /**
     * @param Acl $acl
     */
    public function __construct(Acl $acl)
    {
        $this->acl = $acl;
    }

    /**
     * @param Roles\UsersRolesGetterWrapper $usersRolesGetterWrapper
     */
    public function setUsersRolesGetterWrapper(Roles\UsersRolesGetterWrapper $usersRolesGetterWrapper)
    {
        $this->usersRolesGetterWrapper = $usersRolesGetterWrapper;
    }

    /**
     * @return Roles\UsersRolesGetterWrapper
     */
    public function getUsersRolesGetterWrapper()
    {
        return $this->usersRolesGetterWrapper;
    }

        /**
         * @throws NullException
         */
        private function assertUsersRolesGetterWrapper()
        {
            if (!$this->getUsersRolesGetterWrapper()) {
                throw new NullException("UsersRolesGetterWrapper is not set");
            }
        }

    /**
     * @param array $input
     *
     * @return \Application\Model\QueryBuilderHelperAbstract
     *
     * @throws NullException
     */
    public function recoverRoles($input = array())
    {
        $this->assertUsersRolesGetterWrapper();

        $this->getUsersRolesGetterWrapper()->setInput($input);
        $this->getUsersRolesGetterWrapper()->setupQueryBuilder();

        return $this->getUsersRolesGetterWrapper()->getRecords();
    }

    /**
     * @param array $records
     * @throws NullException
     */
    public function addRoles(array $records)
    {
        if (empty($records)) {
            throw new NullException("Error: no Users Roles on database");
        }

        foreach($records as $record) {
            $this->acl->addRole($record['name']);
        }
    }

    /**
     * @return Acl
     */
    public function getAcl()
    {
        return $this->acl;
    }
}