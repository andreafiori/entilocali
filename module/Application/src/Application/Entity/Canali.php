<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Canali
 *
 * @ORM\Table(name="canali", indexes={@ORM\Index(name="default_language_id", columns={"lingua_id"}), @ORM\Index(name="isdefault", columns={"isdefault"}), @ORM\Index(name="ismultilanguage", columns={"ismultilanguage"})})
 * @ORM\Entity
 */
class Canali
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

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
     * @ORM\Column(name="ismultilanguage", type="bigint", nullable=true)
     */
    private $ismultilanguage;

    /**
     * @var integer
     *
     * @ORM\Column(name="isdefault", type="bigint", nullable=true)
     */
    private $isdefault;

    /**
     * @var \Application\Entity\Lingue
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Lingue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lingua_id", referencedColumnName="id")
     * })
     */
    private $lingua;



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
     * Set nome
     *
     * @param string $nome
     *
     * @return Canali
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return Canali
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
     * @return Canali
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
     *
     * @return Canali
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
     *
     * @return Canali
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
     * Set lingua
     *
     * @param \Application\Entity\Lingue $lingua
     *
     * @return Canali
     */
    public function setLingua(\Application\Entity\Lingue $lingua = null)
    {
        $this->lingua = $lingua;
    
        return $this;
    }

    /**
     * Get lingua
     *
     * @return \Application\Entity\Lingue 
     */
    public function getLingua()
    {
        return $this->lingua;
    }
}
