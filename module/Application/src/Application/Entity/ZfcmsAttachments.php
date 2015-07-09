<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAttachments
 *
 * @ORM\Table(name="zfcms_attachments", indexes={@ORM\Index(name="mime_id", columns={"mime_id"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="fk_attach_language", columns={"language_id"})})
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
     * @ORM\Column(name="title", type="string", length=230, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=250, nullable=false)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=false)
     */
    private $expireDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="atti_concessione_colonna", type="integer", nullable=false)
     */
    private $attiConcessioneColonna;

    /**
     * @var integer
     *
     * @ORM\Column(name="atti_concessione_category", type="integer", nullable=false)
     */
    private $attiConcessioneCategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="albo_rettificato", type="integer", nullable=false)
     */
    private $alboRettificato;

    /**
     * @var integer
     *
     * @ORM\Column(name="albo_id", type="bigint", nullable=false)
     */
    private $alboId;

    /**
     * @var \Application\Entity\ZfcmsLanguages
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsLanguages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;

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
     * Set title
     *
     * @param string $title
     *
     * @return ZfcmsAttachments
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ZfcmsAttachments
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
     * Set name
     *
     * @param string $name
     *
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
     *
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
     * Set status
     *
     * @param string $status
     *
     * @return ZfcmsAttachments
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
     * Set insertDate
     *
     * @param \DateTime $insertDate
     *
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
     * Set expireDate
     *
     * @param \DateTime $expireDate
     *
     * @return ZfcmsAttachments
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
    
        return $this;
    }

    /**
     * Get expireDate
     *
     * @return \DateTime
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return ZfcmsAttachments
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set attiConcessioneColonna
     *
     * @param integer $attiConcessioneColonna
     *
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
     * Set attiConcessioneCategory
     *
     * @param integer $attiConcessioneCategory
     *
     * @return ZfcmsAttachments
     */
    public function setAttiConcessioneCategory($attiConcessioneCategory)
    {
        $this->attiConcessioneCategory = $attiConcessioneCategory;
    
        return $this;
    }

    /**
     * Get attiConcessioneCategory
     *
     * @return integer
     */
    public function getAttiConcessioneCategory()
    {
        return $this->attiConcessioneCategory;
    }

    /**
     * Set alboRettificato
     *
     * @param integer $alboRettificato
     *
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
     *
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
     * Set language
     *
     * @param \Application\Entity\ZfcmsLanguages $language
     *
     * @return ZfcmsAttachments
     */
    public function setLanguage(\Application\Entity\ZfcmsLanguages $language = null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return \Application\Entity\ZfcmsLanguages
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set mime
     *
     * @param \Application\Entity\ZfcmsAttachmentsMimetype $mime
     *
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
     *
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
