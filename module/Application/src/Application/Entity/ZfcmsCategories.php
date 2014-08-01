<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsCategories
 *
 * @ORM\Table(name="zfcms_categories", indexes={@ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class ZfcmsCategories
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
     * @ORM\Column(name="note", type="string", length=100, nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=true)
     */
    private $createDate = '2014-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=true)
     */
    private $lastUpdate = '2014-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=30, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=80, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="column_position", type="string", nullable=true)
     */
    private $columnPosition = 'left';

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=80, nullable=true)
     */
    private $template;

    /**
     * @var \Application\Entity\ZfcmsModules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;



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
     * Set note.
    
     *
     * @param string $note
     *
     * @return ZfcmsCategories
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note.
    
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createDate.
    
     *
     * @param \DateTime $createDate
     *
     * @return ZfcmsCategories
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate.
    
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set lastUpdate.
    
     *
     * @param \DateTime $lastUpdate
     *
     * @return ZfcmsCategories
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate.
    
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set code.
    
     *
     * @param string $code
     *
     * @return ZfcmsCategories
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
     * Set status.
    
     *
     * @param string $status
     *
     * @return ZfcmsCategories
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status.
    
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set columnPosition.
    
     *
     * @param string $columnPosition
     *
     * @return ZfcmsCategories
     */
    public function setColumnPosition($columnPosition)
    {
        $this->columnPosition = $columnPosition;
    
        return $this;
    }

    /**
     * Get columnPosition.
    
     *
     * @return string
     */
    public function getColumnPosition()
    {
        return $this->columnPosition;
    }

    /**
     * Set template.
    
     *
     * @param string $template
     *
     * @return ZfcmsCategories
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get template.
    
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set module.
    
     *
     * @param \Application\Entity\ZfcmsModules $module
     *
     * @return ZfcmsCategories
     */
    public function setModule(\Application\Entity\ZfcmsModules $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module.
    
     *
     * @return \Application\Entity\ZfcmsModules
     */
    public function getModule()
    {
        return $this->module;
    }
}
