<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channels
 *
 * @ORM\Table(name="channels", indexes={@ORM\Index(name="lingua_id", columns={"language_id"}), @ORM\Index(name="is_multilanguage", columns={"is_multilanguage"}), @ORM\Index(name="is_default", columns={"is_default"})})
 * @ORM\Entity
 */
class Channels
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
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=100, nullable=true)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="subdomain", type="string", length=100, nullable=true)
     */
    private $subdomain;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_multilanguage", type="bigint", nullable=true)
     */
    private $isMultilanguage;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_default", type="bigint", nullable=true)
     */
    private $isDefault;

    /**
     * @var \Application\Entity\Languages
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;



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
     *
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
     * Set domain
     *
     * @param string $domain
     *
     * @return Channels
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    
        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set subdomain
     *
     * @param string $subdomain
     *
     * @return Channels
     */
    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;
    
        return $this;
    }

    /**
     * Get subdomain
     *
     * @return string
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * Set isMultilanguage
     *
     * @param integer $isMultilanguage
     *
     * @return Channels
     */
    public function setIsMultilanguage($isMultilanguage)
    {
        $this->isMultilanguage = $isMultilanguage;
    
        return $this;
    }

    /**
     * Get isMultilanguage
     *
     * @return integer
     */
    public function getIsMultilanguage()
    {
        return $this->isMultilanguage;
    }

    /**
     * Set isDefault
     *
     * @param integer $isDefault
     *
     * @return Channels
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    
        return $this;
    }

    /**
     * Get isDefault
     *
     * @return integer
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\Languages $language
     *
     * @return Channels
     */
    public function setLanguage(\Application\Entity\Languages $language = null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return \Application\Entity\Languages
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
