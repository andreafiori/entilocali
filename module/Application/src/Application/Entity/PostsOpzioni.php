<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsOpzioni
 *
 * @ORM\Table(name="posts_opzioni", indexes={@ORM\Index(name="lingua_id", columns={"lingua_id"}), @ORM\Index(name="posts_id", columns={"posts_id"}), @ORM\Index(name="titolo", columns={"titolo"}), @ORM\Index(name="seo_url", columns={"seo_url"}), @ORM\Index(name="seo_title", columns={"seo_title"})})
 * @ORM\Entity
 */
class PostsOpzioni
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
     * @ORM\Column(name="data_da", type="datetime", nullable=true)
     */
    private $dataDa = '2014-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_a", type="datetime", nullable=true)
     */
    private $dataA = '2014-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="string", length=150, nullable=true)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="sottotitolo", type="string", length=150, nullable=true)
     */
    private $sottotitolo;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="text", nullable=true)
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="stato", type="string", length=50, nullable=true)
     */
    private $stato;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="bigint", nullable=true)
     */
    private $posizione = '1';

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
     * @var \Application\Entity\Posts
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="posts_id", referencedColumnName="id")
     * })
     */
    private $posts;

    /**
     * @var \Application\Entity\Lingue
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Lingue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lingua_id", referencedColumnName="id")
     * })
     */
    private $lingua;



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
     * @return PostsOpzioni
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
     * Set dataDa
     *
     * @param \DateTime $dataDa
     *
     * @return PostsOpzioni
     */
    public function setDataDa($dataDa)
    {
        $this->dataDa = $dataDa;
    
        return $this;
    }

    /**
     * Get dataDa
     *
     * @return \DateTime 
     */
    public function getDataDa()
    {
        return $this->dataDa;
    }

    /**
     * Set dataA
     *
     * @param \DateTime $dataA
     *
     * @return PostsOpzioni
     */
    public function setDataA($dataA)
    {
        $this->dataA = $dataA;
    
        return $this;
    }

    /**
     * Get dataA
     *
     * @return \DateTime 
     */
    public function getDataA()
    {
        return $this->dataA;
    }

    /**
     * Set titolo
     *
     * @param string $titolo
     *
     * @return PostsOpzioni
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
     * Set sottotitolo
     *
     * @param string $sottotitolo
     *
     * @return PostsOpzioni
     */
    public function setSottotitolo($sottotitolo)
    {
        $this->sottotitolo = $sottotitolo;
    
        return $this;
    }

    /**
     * Get sottotitolo
     *
     * @return string 
     */
    public function getSottotitolo()
    {
        return $this->sottotitolo;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return PostsOpzioni
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    
        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string 
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set stato
     *
     * @param string $stato
     *
     * @return PostsOpzioni
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    
        return $this;
    }

    /**
     * Get stato
     *
     * @return string 
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     *
     * @return PostsOpzioni
     */
    public function setPosizione($posizione)
    {
        $this->posizione = $posizione;
    
        return $this;
    }

    /**
     * Get posizione
     *
     * @return integer 
     */
    public function getPosizione()
    {
        return $this->posizione;
    }

    /**
     * Set seoUrl
     *
     * @param string $seoUrl
     *
     * @return PostsOpzioni
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
     *
     * @return PostsOpzioni
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
     * @return PostsOpzioni
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
     * @return PostsOpzioni
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
     * Set posts
     *
     * @param \Application\Entity\Posts $posts
     *
     * @return PostsOpzioni
     */
    public function setPosts(\Application\Entity\Posts $posts = null)
    {
        $this->posts = $posts;
    
        return $this;
    }

    /**
     * Get posts
     *
     * @return \Application\Entity\Posts 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set lingua
     *
     * @param \Application\Entity\Lingue $lingua
     *
     * @return PostsOpzioni
     */
    public function setLingua(\Application\Entity\Lingue $lingua = null)
    {
        $this->lingua = $lingua;
    
        return $this;
    }

    /**
     * Get lingua
     *
     * @return \Application\Entity\Lingue 
     */
    public function getLingua()
    {
        return $this->lingua;
    }
}
