<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homepage
 *
 * @ORM\Table(name="homepage", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class Homepage
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
     * @ORM\Column(name="txtfooterbox", type="string", length=100, nullable=false)
     */
    private $txtfooterbox;

    /**
     * @var string
     *
     * @ORM\Column(name="visit_home", type="string", length=100, nullable=false)
     */
    private $visitHome;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=false)
     */
    private $abstract;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataorarif", type="datetime", nullable=false)
     */
    private $dataorarif = '2007-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="scadenza", type="datetime", nullable=false)
     */
    private $scadenza = '2007-01-01 01:01:01';

    /**
     * @var integer
     *
     * @ORM\Column(name="posiz_block", type="integer", nullable=false)
     */
    private $posizBlock = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="modulecategory_id", type="integer", nullable=false)
     */
    private $modulecategoryId = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="news_module_id", type="integer", nullable=false)
     */
    private $newsModuleId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
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
     * Set txtfooterbox
     *
     * @param string $txtfooterbox
     * @return Homepage
     */
    public function setTxtfooterbox($txtfooterbox)
    {
        $this->txtfooterbox = $txtfooterbox;

        return $this;
    }

    /**
     * Get txtfooterbox
     *
     * @return string 
     */
    public function getTxtfooterbox()
    {
        return $this->txtfooterbox;
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
     * Set abstract
     *
     * @param string $abstract
     * @return Homepage
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set dataorarif
     *
     * @param \DateTime $dataorarif
     * @return Homepage
     */
    public function setDataorarif($dataorarif)
    {
        $this->dataorarif = $dataorarif;

        return $this;
    }

    /**
     * Get dataorarif
     *
     * @return \DateTime 
     */
    public function getDataorarif()
    {
        return $this->dataorarif;
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
     * Set posizBlock
     *
     * @param integer $posizBlock
     * @return Homepage
     */
    public function setPosizBlock($posizBlock)
    {
        $this->posizBlock = $posizBlock;

        return $this;
    }

    /**
     * Get posizBlock
     *
     * @return integer 
     */
    public function getPosizBlock()
    {
        return $this->posizBlock;
    }

    /**
     * Set modulecategoryId
     *
     * @param integer $modulecategoryId
     * @return Homepage
     */
    public function setModulecategoryId($modulecategoryId)
    {
        $this->modulecategoryId = $modulecategoryId;

        return $this;
    }

    /**
     * Get modulecategoryId
     *
     * @return integer 
     */
    public function getModulecategoryId()
    {
        return $this->modulecategoryId;
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
