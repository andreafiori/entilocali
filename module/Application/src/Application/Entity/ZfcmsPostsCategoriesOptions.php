<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsPostsCategoriesOptions
 *
 * @ORM\Table(name="zfcms_posts_categories_options", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="name", columns={"name"})})
 * @ORM\Entity
 */
class ZfcmsPostsCategoriesOptions
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
     * @ORM\Column(name="description", type="string", length=80, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_url", type="string", length=80, nullable=true)
     */
    private $seoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=80, nullable=true)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string", length=80, nullable=true)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=120, nullable=true)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="accesskey", type="string", length=10, nullable=true)
     */
    private $accesskey;

    /**
     * @var string
     *
     * @ORM\Column(name="template_file", type="string", length=50, nullable=true)
     */
    private $templateFile;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=true)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=true)
     */
    private $parentId;

    /**
     * @var \Application\Entity\ZfcmsPostsCategories
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsPostsCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

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
     * @return ZfcmsPostsCategoriesOptions
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
     * Set description
     *
     * @param string $description
     * @return ZfcmsPostsCategoriesOptions
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
     * Set seoUrl
     *
     * @param string $seoUrl
     * @return ZfcmsPostsCategoriesOptions
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
     * @return ZfcmsPostsCategoriesOptions
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
     * Set seoKeywords
     *
     * @param string $seoKeywords
     * @return ZfcmsPostsCategoriesOptions
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
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return ZfcmsPostsCategoriesOptions
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
     * Set accesskey
     *
     * @param string $accesskey
     * @return ZfcmsPostsCategoriesOptions
     */
    public function setAccesskey($accesskey)
    {
        $this->accesskey = $accesskey;
    
        return $this;
    }

    /**
     * Get accesskey
     *
     * @return string 
     */
    public function getAccesskey()
    {
        return $this->accesskey;
    }

    /**
     * Set templateFile
     *
     * @param string $templateFile
     * @return ZfcmsPostsCategoriesOptions
     */
    public function setTemplateFile($templateFile)
    {
        $this->templateFile = $templateFile;
    
        return $this;
    }

    /**
     * Get templateFile
     *
     * @return string 
     */
    public function getTemplateFile()
    {
        return $this->templateFile;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ZfcmsPostsCategoriesOptions
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
     * Set parentId
     *
     * @param integer $parentId
     * @return ZfcmsPostsCategoriesOptions
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set category
     *
     * @param \Application\Entity\ZfcmsPostsCategories $category
     * @return ZfcmsPostsCategoriesOptions
     */
    public function setCategory(\Application\Entity\ZfcmsPostsCategories $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Application\Entity\ZfcmsPostsCategories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\ZfcmsLanguages $language
     * @return ZfcmsPostsCategoriesOptions
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
}
