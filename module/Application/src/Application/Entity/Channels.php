<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channels
 *
 * @ORM\Table(name="channels", indexes={@ORM\Index(name="default_language_id", columns={"default_language_id"})})
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
     * @ORM\Column(name="vhost", type="string", length=100, nullable=true)
     */
    private $vhost;

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
     * Set vhost
     *
     * @param string $vhost
     * @return Channels
     */
    public function setVhost($vhost)
    {
        $this->vhost = $vhost;

        return $this;
    }

    /**
     * Get vhost
     *
     * @return string 
     */
    public function getVhost()
    {
        return $this->vhost;
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
