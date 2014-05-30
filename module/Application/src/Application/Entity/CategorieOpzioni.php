<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieOpzioni
 *
 * @ORM\Table(name="categorie_opzioni", indexes={@ORM\Index(name="categoria_id", columns={"categoria_id"}), @ORM\Index(name="lingua_id", columns={"lingua_id"}), @ORM\Index(name="module_id", columns={"modulo_id"})})
 * @ORM\Entity
 */
class CategorieOpzioni
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
     * @ORM\Column(name="nome", type="string", length=80, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=80, nullable=true)
     */
    private $descrizione;

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
     * @ORM\Column(name="posizione", type="bigint", nullable=true)
     */
    private $posizione = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=true)
     */
    private $parentId = '0';

    /**
     * @var \Application\Entity\Categorie
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

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
     * @var \Application\Entity\Moduli
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Moduli")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modulo_id", referencedColumnName="id")
     * })
     */
    private $modulo;



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
     * Set nome
     *
     * @param string $nome
     *
     * @return CategorieOpzioni
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return CategorieOpzioni
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
     * Set seoUrl
     *
     * @param string $seoUrl
     *
     * @return CategorieOpzioni
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
     * @return CategorieOpzioni
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
     *
     * @return CategorieOpzioni
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
     *
     * @return CategorieOpzioni
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
     *
     * @return CategorieOpzioni
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
     *
     * @return CategorieOpzioni
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
     * Set posizione
     *
     * @param integer $posizione
     *
     * @return CategorieOpzioni
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
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return CategorieOpzioni
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
     * Set categoria
     *
     * @param \Application\Entity\Categorie $categoria
     *
     * @return CategorieOpzioni
     */
    public function setCategoria(\Application\Entity\Categorie $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Application\Entity\Categorie
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set lingua
     *
     * @param \Application\Entity\Lingue $lingua
     *
     * @return CategorieOpzioni
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

    /**
     * Set modulo
     *
     * @param \Application\Entity\Moduli $modulo
     *
     * @return CategorieOpzioni
     */
    public function setModulo(\Application\Entity\Moduli $modulo = null)
    {
        $this->modulo = $modulo;
    
        return $this;
    }

    /**
     * Get modulo
     *
     * @return \Application\Entity\Moduli
     */
    public function getModulo()
    {
        return $this->modulo;
    }
}
