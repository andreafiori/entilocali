<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsOptions
 *
 * @ORM\Table(name="posts_options", indexes={@ORM\Index(name="postid", columns={"post_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="title", columns={"title"})})
 * @ORM\Entity
 */
class PostsOptions
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="seourl", type="string", length=150, nullable=true)
     */
    private $seourl;

    /**
     * @var string
     *
     * @ORM\Column(name="seotitle", type="string", length=150, nullable=true)
     */
    private $seotitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="string", length=150, nullable=true)
     */
    private $seodescription;

    /**
     * @var string
     *
     * @ORM\Column(name="seokeywords", type="string", length=150, nullable=true)
     */
    private $seokeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="related", type="string", length=50, nullable=true)
     */
    private $related;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=50, nullable=true)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="integer", nullable=true)
     */
    private $languageId = '1';

    /**
     * @var \Application\Entity\Posts
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;



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
     * @return PostsOptions
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
     * @return PostsOptions
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
     * @return PostsOptions
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
     * Set seourl
     *
     * @param string $seourl
     * @return PostsOptions
     */
    public function setSeourl($seourl)
    {
        $this->seourl = $seourl;

        return $this;
    }

    /**
     * Get seourl
     *
     * @return string 
     */
    public function getSeourl()
    {
        return $this->seourl;
    }

    /**
     * Set seotitle
     *
     * @param string $seotitle
     * @return PostsOptions
     */
    public function setSeotitle($seotitle)
    {
        $this->seotitle = $seotitle;

        return $this;
    }

    /**
     * Get seotitle
     *
     * @return string 
     */
    public function getSeotitle()
    {
        return $this->seotitle;
    }

    /**
     * Set seodescription
     *
     * @param string $seodescription
     * @return PostsOptions
     */
    public function setSeodescription($seodescription)
    {
        $this->seodescription = $seodescription;

        return $this;
    }

    /**
     * Get seodescription
     *
     * @return string 
     */
    public function getSeodescription()
    {
        return $this->seodescription;
    }

    /**
     * Set seokeywords
     *
     * @param string $seokeywords
     * @return PostsOptions
     */
    public function setSeokeywords($seokeywords)
    {
        $this->seokeywords = $seokeywords;

        return $this;
    }

    /**
     * Get seokeywords
     *
     * @return string 
     */
    public function getSeokeywords()
    {
        return $this->seokeywords;
    }

    /**
     * Set related
     *
     * @param string $related
     * @return PostsOptions
     */
    public function setRelated($related)
    {
        $this->related = $related;

        return $this;
    }

    /**
     * Get related
     *
     * @return string 
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return PostsOptions
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
     * Set languageId
     *
     * @param integer $languageId
     * @return PostsOptions
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * Get languageId
     *
     * @return integer 
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Set post
     *
     * @param \Application\Entity\Posts $post
     * @return PostsOptions
     */
    public function setPost(\Application\Entity\Posts $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Application\Entity\Posts 
     */
    public function getPost()
    {
        return $this->post;
    }
}
