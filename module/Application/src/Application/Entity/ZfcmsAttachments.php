<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAttachments
 *
 * @ORM\Table(name="zfcms_attachments", indexes={@ORM\Index(name="mime_id", columns={"mime_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class ZfcmsAttachments
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
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="text", length=65535, nullable=false)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="atti_concessione_colonna", type="integer", nullable=false)
     */
    private $attiConcessioneColonna;

    /**
     * @var integer
     *
     * @ORM\Column(name="albo_rettificato", type="integer", nullable=false)
     */
    private $alboRettificato;

    /**
     * @var integer
     *
     * @ORM\Column(name="albo_id", type="bigint", nullable=true)
     */
    private $alboId;

    /**
     * @var \Application\Entity\ZfcmsAttachmentsMimetype
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsAttachmentsMimetype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mime_id", referencedColumnName="id")
     * })
     */
    private $mime;

    /**
     * @var \Application\Entity\ZfcmsUsers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * @return ZfcmsAttachments
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
     * Set size
     *
     * @param string $size
     * @return ZfcmsAttachments
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return ZfcmsAttachments
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
     * Set insertDate
     *
     * @param \DateTime $insertDate
     * @return ZfcmsAttachments
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    
        return $this;
    }

    /**
     * Get insertDate
     *
     * @return \DateTime 
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set attiConcessioneColonna
     *
     * @param integer $attiConcessioneColonna
     * @return ZfcmsAttachments
     */
    public function setAttiConcessioneColonna($attiConcessioneColonna)
    {
        $this->attiConcessioneColonna = $attiConcessioneColonna;
    
        return $this;
    }

    /**
     * Get attiConcessioneColonna
     *
     * @return integer 
     */
    public function getAttiConcessioneColonna()
    {
        return $this->attiConcessioneColonna;
    }

    /**
     * Set alboRettificato
     *
     * @param integer $alboRettificato
     * @return ZfcmsAttachments
     */
    public function setAlboRettificato($alboRettificato)
    {
        $this->alboRettificato = $alboRettificato;
    
        return $this;
    }

    /**
     * Get alboRettificato
     *
     * @return integer 
     */
    public function getAlboRettificato()
    {
        return $this->alboRettificato;
    }

    /**
     * Set alboId
     *
     * @param integer $alboId
     * @return ZfcmsAttachments
     */
    public function setAlboId($alboId)
    {
        $this->alboId = $alboId;
    
        return $this;
    }

    /**
     * Get alboId
     *
     * @return integer 
     */
    public function getAlboId()
    {
        return $this->alboId;
    }

    /**
     * Set mime
     *
     * @param \Application\Entity\ZfcmsAttachmentsMimetype $mime
     * @return ZfcmsAttachments
     */
    public function setMime(\Application\Entity\ZfcmsAttachmentsMimetype $mime = null)
    {
        $this->mime = $mime;
    
        return $this;
    }

    /**
     * Get mime
     *
     * @return \Application\Entity\ZfcmsAttachmentsMimetype 
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\ZfcmsUsers $user
     * @return ZfcmsAttachments
     */
    public function setUser(\Application\Entity\ZfcmsUsers $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\ZfcmsUsers 
     */
    public function getUser()
    {
        return $this->user;
    }
}
