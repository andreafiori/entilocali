<?php

namespace AdminTest\Model\Users;

use Admin\Model\Users\AclSetter;
use Admin\Model\Users\Roles\UsersRolesGetter;
use Admin\Model\Users\Roles\UsersRolesGetterWrapper;
use Zend\Permissions\Acl\Acl;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  15 June 2013
 */
class AclSetterTest extends TestSuite
{
    /**
     * @var AclSetter
     */
    private $aclSetter;

    protected function setUp()
    {
        parent::setUp();

        $this->aclSetter = new AclSetter(new Acl());
    }

    public function testRecoverRoles()
    {
        $this->setupUsersRolesGetterWrapper();

        $this->assertTrue(is_array($this->aclSetter->recoverRoles()));
    }

    public function testAddRoles()
    {
        $this->setupRoles();

        $this->assertTrue(is_array($this->aclSetter->getAcl()->getRoles()));
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testRecoverRolesThrowsException()
    {
        $this->aclSetter->recoverRoles();
    }

        private function setupUsersRolesGetterWrapper()
        {
            $this->aclSetter->setUsersRolesGetterWrapper(new UsersRolesGetterWrapper(
                    new UsersRolesGetter($this->getEntityManagerMock())
                )
            );
        }

        private function setupRoles()
        {
            $this->aclSetter->addRoles(array(
                    array(
                        'id' => 1,
                        'name' => 'WebMaster',
                    ),
                    array(
                        'id' => 2,
                        'name' => 'SuperAdmin',
                    ),
                    array(
                        'id' => 2,
                        'name' => 'Community',
                    ),
                    array(
                        'id' => 2,
                        'name' => 'Delegato',
                    ),
                )
            );
        }
}