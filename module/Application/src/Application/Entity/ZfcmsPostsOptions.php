<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsPostsOptions
 *
 * @ORM\Table(name="zfcms_posts_options", indexes={@ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="posts_id", columns={"posts_id"}), @ORM\Index(name="seo_title", columns={"seo_title"}), @ORM\Index(name="title", columns={"title"})})
 * @ORM\Entity
 */
class ZfcmsPostsOptions
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
     * @ORM\Column(name="date_from", type="datetime", nullable=true)
     */
    private $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_to", type="datetime", nullable=true)
     */
    private $dataTo;

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
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_url", type="string", length=150, nullable=true)
     */
    private $seoUrl;

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
     * @ORM\Column(name="href", type="text", length=65535, nullable=true)
     */
    private $href;

    /**
     * @var integer
     *
     * @ORM\Column(name="always_in_home", type="integer", nullable=true)
     */
    private $alwaysInHome;

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
     * @var \Application\Entity\ZfcmsPosts
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsPosts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="posts_id", referencedColumnName="id")
     * })
     */
    private $posts;



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
     * @return ZfcmsPostsOptions
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
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return ZfcmsPostsOptions
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    
        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dataTo
     *
     * @param \DateTime $dataTo
     * @return ZfcmsPostsOptions
     */
    public function setDataTo($dataTo)
    {
        $this->dataTo = $dataTo;
    
        return $this;
    }

    /**
     * Get dataTo
     *
     * @return \DateTime 
     */
    public function getDataTo()
    {
        return $this->dataTo;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * Set seoUrl
     *
     * @param string $seoUrl
     * @return ZfcmsPostsOptions
     */
    public function setSeoUrl($seoUrl)
    {
        $this->seoUrl = $seoUrl;
    
        return $this;
    }

    /**
     * Get seoUrl
     *
     * @return string 
     */
    public function getSeoUrl()
    {
        return $this->seoUrl;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * Set href
     *
     * @param string $href
     * @return ZfcmsPostsOptions
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
     * @return ZfcmsPostsOptions
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
     * Set language
     *
     * @param \Application\Entity\ZfcmsLanguages $language
     * @return ZfcmsPostsOptions
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
     * Set posts
     *
     * @param \Application\Entity\ZfcmsPosts $posts
     * @return ZfcmsPostsOptions
     */
    public function setPosts(\Application\Entity\ZfcmsPosts $posts = null)
    {
        $this->posts = $posts;
    
        return $this;
    }

    /**
     * Get posts
     *
     * @return \Application\Entity\ZfcmsPosts 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
