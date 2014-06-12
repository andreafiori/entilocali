<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LanguagesLabels
 *
 * @ORM\Table(name="languages_labels", indexes={@ORM\Index(name="linguage_id", columns={"linguage_id"}), @ORM\Index(name="module_id", columns={"module_id"})})
 * @ORM\Entity
 */
class LanguagesLabels
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
     * @ORM\Column(name="name", type="string", length=80, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_backend", type="bigint", nullable=true)
     */
    private $isBackend = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="is_universal", type="bigint", nullable=true)
     */
    private $isUniversal = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="bigint", nullable=true)
     */
    private $moduleId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="linguage_id", type="bigint", nullable=true)
     */
    private $linguageId = '1';



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
     * @return LanguagesLabels
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
     * Set value
     *
     * @param string $value
     *
     * @return LanguagesLabels
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set description
     *
     * @param string $description
     *
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
     * Set isBackend
     *
     * @param integer $isBackend
     *
     * @return LanguagesLabels
     */
    public function setIsBackend($isBackend)
    {
        $this->isBackend = $isBackend;
    
        return $this;
    }

    /**
     * Get isBackend
     *
     * @return integer
     */
    public function getIsBackend()
    {
        return $this->isBackend;
    }

    /**
     * Set isUniversal
     *
     * @param integer $isUniversal
     *
     * @return LanguagesLabels
     */
    public function setIsUniversal($isUniversal)
    {
        $this->isUniversal = $isUniversal;
    
        return $this;
    }

    /**
     * Get isUniversal
     *
     * @return integer
     */
    public function getIsUniversal()
    {
        return $this->isUniversal;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return LanguagesLabels
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     *
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
     * Set linguageId
     *
     * @param integer $linguageId
     *
     * @return LanguagesLabels
     */
    public function setLinguageId($linguageId)
    {
        $this->linguageId = $linguageId;
    
        return $this;
    }

    /**
     * Get linguageId
     *
     * @return integer
     */
    public function getLinguageId()
    {
        return $this->linguageId;
    }
}
