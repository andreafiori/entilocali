<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModulesOptions
 *
 * @ORM\Table(name="modules_options", indexes={@ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="module_id", columns={"module_id"})})
 * @ORM\Entity
 */
class ModulesOptions
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name = '0';

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
     * @var \Application\Entity\Modules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;



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
     * @return ModulesOptions
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
     * Set language
     *
     * @param \Application\Entity\Languages $language
     *
     * @return ModulesOptions
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

    /**
     * Set module
     *
     * @param \Application\Entity\Modules $module
     *
     * @return ModulesOptions
     */
    public function setModule(\Application\Entity\Modules $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\Modules
     */
    public function getModule()
    {
        return $this->module;
    }
}
