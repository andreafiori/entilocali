<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsersPermissionsNames
 *
 * @ORM\Table(name="zfcms_users_permissions_names")
 * @ORM\Entity
 */
class ZfcmsUsersPermissionsNames
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=50, nullable=true)
     */
    private $flag = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=true)
     */
    private $description = '';



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
     * Set flag.
    
     *
     * @param string $flag
     *
     * @return ZfcmsUsersPermissionsNames
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    
        return $this;
    }

    /**
     * Get flag.
    
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set description.
    
     *
     * @param string $description
     *
     * @return ZfcmsUsersPermissionsNames
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description.
    
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
