<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriesOptions
 *
 * @ORM\Table(name="categories_options", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="catoptionskeys", columns={"language_id", "name"}), @ORM\Index(name="IDX_F83F2B2782F1BAF4", columns={"language_id"})})
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
     * @ORM\Column(name="code", type="string", length=80, nullable=true)
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
     * @ORM\Column(name="seonameslug", type="string", length=80, nullable=true)
     */
    private $seonameslug;

    /**
     * @var string
     *
     * @ORM\Column(name="titledescription", type="string", length=80, nullable=true)
     */
    private $titledescription = '1';

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
     * @return CategoriesOptions
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
     * Set seonameslug
     *
     * @param string $seonameslug
     * @return CategoriesOptions
     */
    public function setSeonameslug($seonameslug)
    {
        $this->seonameslug = $seonameslug;

        return $this;
    }

    /**
     * Get seonameslug
     *
     * @return string 
     */
    public function getSeonameslug()
    {
        return $this->seonameslug;
    }

    /**
     * Set titledescription
     *
     * @param string $titledescription
     * @return CategoriesOptions
     */
    public function setTitledescription($titledescription)
    {
        $this->titledescription = $titledescription;

        return $this;
    }

    /**
     * Get titledescription
     *
     * @return string 
     */
    public function getTitledescription()
    {
        return $this->titledescription;
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
}
