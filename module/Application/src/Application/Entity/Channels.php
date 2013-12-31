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
     * @ORM\Column(name="development", type="string", length=100, nullable=true)
     */
    private $development = 'localhost';

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
     * Set development
     *
     * @param string $development
     * @return Channels
     */
    public function setDevelopment($development)
    {
        $this->development = $development;

        return $this;
    }

    /**
     * Get development
     *
     * @return string 
     */
    public function getDevelopment()
    {
        return $this->development;
    }

    /**
     * Set domain
     *
     * @param string $domain
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
