<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="catoptionskeys", columns={"language_id", "name"}), @ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="code", columns={"code"}), @ORM\Index(name="IDX_3AF3466882F1BAF4", columns={"language_id"})})
 * @ORM\Entity
 */
class Categories
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
     * @ORM\Column(name="code", type="string", length=30, nullable=true)
     */
    private $code;

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
     * @ORM\Column(name="seo_slug", type="string", length=80, nullable=true)
     */
    private $seoSlug;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=80, nullable=true)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=80, nullable=true)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=80, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="orderby_fieldname", type="string", length=80, nullable=true)
     */
    private $orderbyFieldname;

    /**
     * @var string
     *
     * @ORM\Column(name="accesskey", type="string", length=5, nullable=true)
     */
    private $accesskey;

    /**
     * @var string
     *
     * @ORM\Column(name="templatefile", type="string", length=30, nullable=true)
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
     * @var \Application\Entity\Channels
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Channels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     * })
     */
    private $channel;

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
     * Set code
     *
     * @param string $code
     * @return Categories
     */
    public function setId($id)
    {
    	$this->id = $id;
    
    	return $this;
    }

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
     * Set code
     *
     * @param string $code
     * @return Categories
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Categories
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
     * @return Categories
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
     * Set seoSlug
     *
     * @param string $seoSlug
     * @return Categories
     */
    public function setSeoSlug($seoSlug)
    {
        $this->seoSlug = $seoSlug;

        return $this;
    }

    /**
     * Get seoSlug
     *
     * @return string 
     */
    public function getSeoSlug()
    {
        return $this->seoSlug;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return Categories
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
     * @return Categories
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
     * Set status
     *
     * @param string $status
     * @return Categories
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
     * Set orderbyFieldname
     *
     * @param string $orderbyFieldname
     * @return Categories
     */
    public function setOrderbyFieldname($orderbyFieldname)
    {
        $this->orderbyFieldname = $orderbyFieldname;

        return $this;
    }

    /**
     * Get orderbyFieldname
     *
     * @return string 
     */
    public function getOrderbyFieldname()
    {
        return $this->orderbyFieldname;
    }

    /**
     * Set accesskey
     *
     * @param string $accesskey
     * @return Categories
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
     * @return Categories
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
     * @return Categories
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
     * @return Categories
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
     * Set channel
     *
     * @param \Application\Entity\Channels $channel
     * @return Categories
     */
    public function setChannel(\Application\Entity\Channels $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \Application\Entity\Channels 
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\Languages $language
     * @return Categories
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
     * @return Categories
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
