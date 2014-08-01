<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsersPermissions
 *
 * @ORM\Table(name="zfcms_users_permissions", indexes={@ORM\Index(name="ruolo_id", columns={"role_id"}), @ORM\Index(name="permesso_id", columns={"permession_id"})})
 * @ORM\Entity
 */
class ZfcmsUsersPermissions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     */
    private $code = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=50, nullable=false)
     */
    private $value = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="bigint", nullable=false)
     */
    private $roleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="permession_id", type="bigint", nullable=false)
     */
    private $permessionId;



    /**
     * Get id.
    
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code.
    
     *
     * @param string $code
     *
     * @return ZfcmsUsersPermissions
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code.
    
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set value.
    
     *
     * @param string $value
     *
     * @return ZfcmsUsersPermissions
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value.
    
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set roleId.
    
     *
     * @param integer $roleId
     *
     * @return ZfcmsUsersPermissions
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    
        return $this;
    }

    /**
     * Get roleId.
    
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set permessionId.
    
     *
     * @param integer $permessionId
     *
     * @return ZfcmsUsersPermissions
     */
    public function setPermessionId($permessionId)
    {
        $this->permessionId = $permessionId;
    
        return $this;
    }

    /**
     * Get permessionId.
    
     *
     * @return integer
     */
    public function getPermessionId()
    {
        return $this->permessionId;
    }
}
