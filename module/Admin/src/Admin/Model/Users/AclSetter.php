<?php

namespace Admin\Model\Users;

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
     * @param Acl $acl
     */
    public function __construct(Acl $acl)
    {
        $this->acl = $acl;
    }

    public function addRoles()
    {
        $this->acl->addRole('WebMaster');
        $this->acl->addRole('SuperAdmin');
        $this->acl->addRole('Dipendente');
        $this->acl->addRole('Community');
        $this->acl->addRole('Delegato');
    }

    /**
     * Add Resources (permission names) to ACL
     */
    public function addResources()
    {
        $this->acl->addResource(new Resource('UpdateUsersOnModules'));
        $this->acl->addResource(new Resource('WebMasterTools'));
    }

    /**
     * Set permission (based on resources)
     */
    public function setupPermissions()
    {
        $this->acl->allow('WebMaster');
        $this->acl->allow('SuperAdmin');

        $this->acl->deny('SuperAdmin', 'WebMasterTools');
    }

    /**
     * @return Acl
     */
    public function getAcl()
    {
        return $this->acl;
    }
}