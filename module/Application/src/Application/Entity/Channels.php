<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channels
 *
 * @ORM\Table(name="channels", indexes={@ORM\Index(name="default_language_id", columns={"default_language_id"}), @ORM\Index(name="isdefault", columns={"isdefault"}), @ORM\Index(name="ismultilanguage", columns={"ismultilanguage"})})
 * @ORM\Entity
 */
class Channels
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="vhost_production", type="string", length=100, nullable=true)
     */
    private $vhostProduction;

    /**
     * @var string
     *
     * @ORM\Column(name="vhost_staging", type="string", length=100, nullable=true)
     */
    private $vhostStaging;

    /**
     * @var integer
     *
     * @ORM\Column(name="ismultilanguage", type="integer", nullable=true)
     */
    private $ismultilanguage;

    /**
     * @var integer
     *
     * @ORM\Column(name="isdefault", type="integer", nullable=true)
     */
    private $isdefault;

    /**
     * @var \Application\Entity\Languages
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="default_language_id", referencedColumnName="id")
     * })
     */
    private $defaultLanguage;

    /**
     * Set id
     *
     * @param integer $id
     * @return Channels
     */
    public function setId($id)
    {
    	$this->id = $id;
    
    	return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Channels
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set vhostProduction
     *
     * @param string $vhostProduction
     * @return Channels
     */
    public function setVhostProduction($vhostProduction)
    {
        $this->vhostProduction = $vhostProduction;

        return $this;
    }

    /**
     * Get vhostProduction
     *
     * @return string 
     */
    public function getVhostProduction()
    {
        return $this->vhostProduction;
    }

    /**
     * Set vhostStaging
     *
     * @param string $vhostStaging
     * @return Channels
     */
    public function setVhostStaging($vhostStaging)
    {
        $this->vhostStaging = $vhostStaging;

        return $this;
    }

    /**
     * Get vhostStaging
     *
     * @return string 
     */
    public function getVhostStaging()
    {
        return $this->vhostStaging;
    }

    /**
     * Set ismultilanguage
     *
     * @param integer $ismultilanguage
     * @return Channels
     */
    public function setIsmultilanguage($ismultilanguage)
    {
        $this->ismultilanguage = $ismultilanguage;

        return $this;
    }

    /**
     * Get ismultilanguage
     *
     * @return integer 
     */
    public function getIsmultilanguage()
    {
        return $this->ismultilanguage;
    }

    /**
     * Set isdefault
     *
     * @param integer $isdefault
     * @return Channels
     */
    public function setIsdefault($isdefault)
    {
        $this->isdefault = $isdefault;

        return $this;
    }

    /**
     * Get isdefault
     *
     * @return integer 
     */
    public function getIsdefault()
    {
        return $this->isdefault;
    }

    /**
     * Set defaultLanguage
     *
     * @param \Application\Entity\Languages $defaultLanguage
     * @return Channels
     */
    public function setDefaultLanguage(\Application\Entity\Languages $defaultLanguage = null)
    {
        $this->defaultLanguage = $defaultLanguage;

        return $this;
    }

    /**
     * Get defaultLanguage
     *
     * @return \Application\Entity\Languages 
     */
    public function getDefaultLanguage()
    {
        return $this->defaultLanguage;
    }
}
