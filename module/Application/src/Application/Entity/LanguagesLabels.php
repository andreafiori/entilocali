<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LanguagesLabels
 *
 * @ORM\Table(name="languages_labels", indexes={@ORM\Index(name="language", columns={"language_id"})})
 * @ORM\Entity
 */
class LanguagesLabels
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
     * @ORM\Column(name="labelname", type="string", length=80, nullable=true)
     */
    private $labelname;

    /**
     * @var string
     *
     * @ORM\Column(name="labelvalue", type="text", nullable=true)
     */
    private $labelvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="isadmin", type="integer", nullable=true)
     */
    private $isadmin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="isuniversal", type="integer", nullable=true)
     */
    private $isuniversal = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=true)
     */
    private $moduleId = '0';

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
     * Set labelname
     *
     * @param string $labelname
     * @return LanguagesLabels
     */
    public function setLabelname($labelname)
    {
        $this->labelname = $labelname;

        return $this;
    }

    /**
     * Get labelname
     *
     * @return string 
     */
    public function getLabelname()
    {
        return $this->labelname;
    }

    /**
     * Set labelvalue
     *
     * @param string $labelvalue
     * @return LanguagesLabels
     */
    public function setLabelvalue($labelvalue)
    {
        $this->labelvalue = $labelvalue;

        return $this;
    }

    /**
     * Get labelvalue
     *
     * @return string 
     */
    public function getLabelvalue()
    {
        return $this->labelvalue;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return LanguagesLabels
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isadmin
     *
     * @param integer $isadmin
     * @return LanguagesLabels
     */
    public function setIsadmin($isadmin)
    {
        $this->isadmin = $isadmin;

        return $this;
    }

    /**
     * Get isadmin
     *
     * @return integer 
     */
    public function getIsadmin()
    {
        return $this->isadmin;
    }

    /**
     * Set isuniversal
     *
     * @param integer $isuniversal
     * @return LanguagesLabels
     */
    public function setIsuniversal($isuniversal)
    {
        $this->isuniversal = $isuniversal;

        return $this;
    }

    /**
     * Get isuniversal
     *
     * @return integer 
     */
    public function getIsuniversal()
    {
        return $this->isuniversal;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return LanguagesLabels
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     * @return LanguagesLabels
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer 
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\Languages $language
     * @return LanguagesLabels
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
