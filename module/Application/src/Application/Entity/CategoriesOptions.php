<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriesOptions
 *
 * @ORM\Table(name="categories_options", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="name", columns={"name"}), @ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class CategoriesOptions
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
     * @ORM\Column(name="templatefile", type="string", length=50, nullable=true)
     */
    private $templatefile;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId = '0';

    /**
     * @var \Application\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

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
     * @var \Application\Entity\Modules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;



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
     * @return CategoriesOptions
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
     * @return CategoriesOptions
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
     * @return CategoriesOptions
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
     * @return CategoriesOptions
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
     * @return CategoriesOptions
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
     * @return CategoriesOptions
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
     * @return CategoriesOptions
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
     * Set templatefile
     *
     * @param string $templatefile
     * @return CategoriesOptions
     */
    public function setTemplatefile($templatefile)
    {
        $this->templatefile = $templatefile;

        return $this;
    }

    /**
     * Get templatefile
     *
     * @return string 
     */
    public function getTemplatefile()
    {
        return $this->templatefile;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return CategoriesOptions
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
     * @param \Application\Entity\Categories $category
     * @return CategoriesOptions
     */
    public function setCategory(\Application\Entity\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Application\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\Languages $language
     * @return CategoriesOptions
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

    /**
     * Set module
     *
     * @param \Application\Entity\Modules $module
     * @return CategoriesOptions
     */
    public function setModule(\Application\Entity\Modules $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\Modules 
     */
    public function getModule()
    {
        return $this->module;
    }
}
