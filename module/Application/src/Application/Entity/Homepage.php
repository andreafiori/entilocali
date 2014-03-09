<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homepage
 *
 * @ORM\Table(name="homepage", indexes={@ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="module_id", columns={"module_id"})})
 * @ORM\Entity
 */
class Homepage
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
     * @ORM\Column(name="boxhome", type="string", nullable=false)
     */
    private $boxhome = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=100, nullable=false)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="string", length=100, nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=100, nullable=false)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="sublink", type="string", nullable=false)
     */
    private $sublink = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="footer_text", type="string", length=100, nullable=false)
     */
    private $footerText;

    /**
     * @var string
     *
     * @ORM\Column(name="visit_home", type="string", length=100, nullable=false)
     */
    private $visitHome;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract_description", type="text", nullable=false)
     */
    private $abstractDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime_reference", type="datetime", nullable=false)
     */
    private $datetimeReference = '2007-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="scadenza", type="datetime", nullable=false)
     */
    private $scadenza = '2007-01-01 01:01:01';

    /**
     * @var integer
     *
     * @ORM\Column(name="posizition_block", type="bigint", nullable=false)
     */
    private $posizitionBlock = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="news_module_id", type="bigint", nullable=false)
     */
    private $newsModuleId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="bigint", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="bigint", nullable=false)
     */
    private $moduleId = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="bigint", nullable=false)
     */
    private $channelId = '1';

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
     * Set boxhome
     *
     * @param string $boxhome
     * @return Homepage
     */
    public function setBoxhome($boxhome)
    {
        $this->boxhome = $boxhome;

        return $this;
    }

    /**
     * Get boxhome
     *
     * @return string 
     */
    public function getBoxhome()
    {
        return $this->boxhome;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Homepage
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set titolo
     *
     * @param string $titolo
     * @return Homepage
     */
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;

        return $this;
    }

    /**
     * Get titolo
     *
     * @return string 
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return Homepage
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set sublink
     *
     * @param string $sublink
     * @return Homepage
     */
    public function setSublink($sublink)
    {
        $this->sublink = $sublink;

        return $this;
    }

    /**
     * Get sublink
     *
     * @return string 
     */
    public function getSublink()
    {
        return $this->sublink;
    }

    /**
     * Set footerText
     *
     * @param string $footerText
     * @return Homepage
     */
    public function setFooterText($footerText)
    {
        $this->footerText = $footerText;

        return $this;
    }

    /**
     * Get footerText
     *
     * @return string 
     */
    public function getFooterText()
    {
        return $this->footerText;
    }

    /**
     * Set visitHome
     *
     * @param string $visitHome
     * @return Homepage
     */
    public function setVisitHome($visitHome)
    {
        $this->visitHome = $visitHome;

        return $this;
    }

    /**
     * Get visitHome
     *
     * @return string 
     */
    public function getVisitHome()
    {
        return $this->visitHome;
    }

    /**
     * Set abstractDescription
     *
     * @param string $abstractDescription
     * @return Homepage
     */
    public function setAbstractDescription($abstractDescription)
    {
        $this->abstractDescription = $abstractDescription;

        return $this;
    }

    /**
     * Get abstractDescription
     *
     * @return string 
     */
    public function getAbstractDescription()
    {
        return $this->abstractDescription;
    }

    /**
     * Set datetimeReference
     *
     * @param \DateTime $datetimeReference
     * @return Homepage
     */
    public function setDatetimeReference($datetimeReference)
    {
        $this->datetimeReference = $datetimeReference;

        return $this;
    }

    /**
     * Get datetimeReference
     *
     * @return \DateTime 
     */
    public function getDatetimeReference()
    {
        return $this->datetimeReference;
    }

    /**
     * Set scadenza
     *
     * @param \DateTime $scadenza
     * @return Homepage
     */
    public function setScadenza($scadenza)
    {
        $this->scadenza = $scadenza;

        return $this;
    }

    /**
     * Get scadenza
     *
     * @return \DateTime 
     */
    public function getScadenza()
    {
        return $this->scadenza;
    }

    /**
     * Set posizitionBlock
     *
     * @param integer $posizitionBlock
     * @return Homepage
     */
    public function setPosizitionBlock($posizitionBlock)
    {
        $this->posizitionBlock = $posizitionBlock;

        return $this;
    }

    /**
     * Get posizitionBlock
     *
     * @return integer 
     */
    public function getPosizitionBlock()
    {
        return $this->posizitionBlock;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Homepage
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
     * Set newsModuleId
     *
     * @param integer $newsModuleId
     * @return Homepage
     */
    public function setNewsModuleId($newsModuleId)
    {
        $this->newsModuleId = $newsModuleId;

        return $this;
    }

    /**
     * Get newsModuleId
     *
     * @return integer 
     */
    public function getNewsModuleId()
    {
        return $this->newsModuleId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Homepage
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     * @return Homepage
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
     * Set channelId
     *
     * @param integer $channelId
     * @return Homepage
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Get channelId
     *
     * @return integer 
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\Languages $language
     * @return Homepage
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
