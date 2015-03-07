<?php

namespace AdminTest\Model\Users;

use Admin\Model\Users\AclSetter;
use Zend\Permissions\Acl\Acl;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  15 June 2013
 */
class AclSetterTest extends TestSuite
{
    private $aclSetter;

    protected function setUp()
    {
        parent::setUp();

        $this->aclSetter = new AclSetter(new Acl());
    }

    public function testAddRoles()
    {
        $this->aclSetter->addRoles();

        $this->assertTrue(is_array($this->aclSetter->getAcl()->getRoles()));
    }

    public function testAddResources()
    {
        $this->aclSetter->addResources();

        $this->assertTrue(is_array($this->aclSetter->getAcl()->getResources()));
    }

    public function testSetupPermissions()
    {
        $this->aclSetter->addRoles();
        $this->aclSetter->addResources();
        $this->aclSetter->setupPermissions();

        $this->assertTrue($this->aclSetter->getAcl()->isAllowed('WebMaster', 'UpdateUsersOnModules'));
        $this->assertFalse($this->aclSetter->getAcl()->isAllowed('SuperAdmin', 'WebMasterTools'));
    }
}