<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsPosts
 *
 * @ORM\Table(name="zfcms_posts", indexes={@ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="seo_title", columns={"seo_title"}), @ORM\Index(name="title", columns={"title"}), @ORM\Index(name="fk_posts_user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class ZfcmsPosts
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
    private $createDate = '2015-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=true)
     */
    private $expireDate = '2015-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=true)
     */
    private $lastUpdate = '2015-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=80, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_homepage", type="string", length=80, nullable=true)
     */
    private $imageHomepage;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=150, nullable=true)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=true)
     */
    private $position = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=150, nullable=true)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=150, nullable=true)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string", length=150, nullable=true)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=150, nullable=true)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=150, nullable=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="href", type="text", length=65535, nullable=true)
     */
    private $href;

    /**
     * @var integer
     *
     * @ORM\Column(name="always_in_home", type="integer", nullable=false)
     */
    private $alwaysInHome;

    /**
     * @var integer
     *
     * @ORM\Column(name="box_notizie", type="integer", nullable=false)
     */
    private $boxNotizie;

    /**
     * @var integer
     *
     * @ORM\Column(name="homepage", type="integer", nullable=false)
     */
    private $homepage;

    /**
     * @var integer
     *
     * @ORM\Column(name="has_attachments", type="integer", nullable=false)
     */
    private $hasAttachments;

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
     * Set note
     *
     * @param string $note
     *
     * @return ZfcmsPosts
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return ZfcmsPosts
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set expireDate
     *
     * @param \DateTime $expireDate
     *
     * @return ZfcmsPosts
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
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return ZfcmsPosts
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return ZfcmsPosts
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageHomepage
     *
     * @param string $imageHomepage
     *
     * @return ZfcmsPosts
     */
    public function setImageHomepage($imageHomepage)
    {
        $this->imageHomepage = $imageHomepage;
    
        return $this;
    }

    /**
     * Get imageHomepage
     *
     * @return string
     */
    public function getImageHomepage()
    {
        return $this->imageHomepage;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ZfcmsPosts
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
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return ZfcmsPosts
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
     * Set description
     *
     * @param string $description
     *
     * @return ZfcmsPosts
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
     * Set status
     *
     * @param string $status
     *
     * @return ZfcmsPosts
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
     * Set position
     *
     * @param integer $position
     *
     * @return ZfcmsPosts
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
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return ZfcmsPosts
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;
    
        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return ZfcmsPosts
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;
    
        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     *
     * @return ZfcmsPosts
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;
    
        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set template
     *
     * @param string $template
     *
     * @return ZfcmsPosts
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ZfcmsPosts
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set href
     *
     * @param string $href
     *
     * @return ZfcmsPosts
     */
    public function setHref($href)
    {
        $this->href = $href;
    
        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set alwaysInHome
     *
     * @param integer $alwaysInHome
     *
     * @return ZfcmsPosts
     */
    public function setAlwaysInHome($alwaysInHome)
    {
        $this->alwaysInHome = $alwaysInHome;
    
        return $this;
    }

    /**
     * Get alwaysInHome
     *
     * @return integer
     */
    public function getAlwaysInHome()
    {
        return $this->alwaysInHome;
    }

    /**
     * Set boxNotizie
     *
     * @param integer $boxNotizie
     *
     * @return ZfcmsPosts
     */
    public function setBoxNotizie($boxNotizie)
    {
        $this->boxNotizie = $boxNotizie;
    
        return $this;
    }

    /**
     * Get boxNotizie
     *
     * @return integer
     */
    public function getBoxNotizie()
    {
        return $this->boxNotizie;
    }

    /**
     * Set homepage
     *
     * @param integer $homepage
     *
     * @return ZfcmsPosts
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    
        return $this;
    }

    /**
     * Get homepage
     *
     * @return integer
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set hasAttachments
     *
     * @param integer $hasAttachments
     *
     * @return ZfcmsPosts
     */
    public function setHasAttachments($hasAttachments)
    {
        $this->hasAttachments = $hasAttachments;
    
        return $this;
    }

    /**
     * Get hasAttachments
     *
     * @return integer
     */
    public function getHasAttachments()
    {
        return $this->hasAttachments;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\ZfcmsLanguages $language
     *
     * @return ZfcmsPosts
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
     * Set user
     *
     * @param \Application\Entity\ZfcmsUsers $user
     *
     * @return ZfcmsPosts
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
