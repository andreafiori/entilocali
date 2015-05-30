<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniSezioni
 *
 * @ORM\Table(name="zfcms_comuni_sezioni", indexes={@ORM\Index(name="fk_sezioni_modulo_id", columns={"modulo_id"}), @ORM\Index(name="fk_sezioni_user_id", columns={"utente_id"}), @ORM\Index(name="fk_sezioni_lingua_id", columns={"lingua"})})
 * @ORM\Entity
 */
class ZfcmsComuniSezioni
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
     * @ORM\Column(name="nome", type="text", length=65535, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="colonna", type="string", length=100, nullable=false)
     */
    private $colonna;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="integer", nullable=false)
     */
    private $posizione;

    /**
     * @var integer
     *
     * @ORM\Column(name="link_macro", type="integer", nullable=false)
     */
    private $linkMacro;

    /**
     * @var integer
     *
     * @ORM\Column(name="blocco", type="integer", nullable=false)
     */
    private $blocco;

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=false)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="css_id", type="integer", nullable=true)
     */
    private $cssId;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=80, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=80, nullable=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=80, nullable=true)
     */
    private $title;

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
     * @ORM\Column(name="seo_keywords", type="string", length=80, nullable=true)
     */
    private $seoKeywords;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_amm_trasparente", type="integer", nullable=true)
     */
    private $isAmmTrasparente;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_to_all", type="integer", nullable=false)
     */
    private $showToAll;

    /**
     * @var \Application\Entity\ZfcmsLanguages
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsLanguages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lingua", referencedColumnName="id")
     * })
     */
    private $lingua;

    /**
     * @var \Application\Entity\ZfcmsModules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modulo_id", referencedColumnName="id")
     * })
     */
    private $modulo;

    /**
     * @var \Application\Entity\ZfcmsUsers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utente_id", referencedColumnName="id")
     * })
     */
    private $utente;



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
     * @return ZfcmsComuniSezioni
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
     * Set colonna
     *
     * @param string $colonna
     * @return ZfcmsComuniSezioni
     */
    public function setColonna($colonna)
    {
        $this->colonna = $colonna;
    
        return $this;
    }

    /**
     * Get colonna
     *
     * @return string 
     */
    public function getColonna()
    {
        return $this->colonna;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return ZfcmsComuniSezioni
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
     * Set linkMacro
     *
     * @param integer $linkMacro
     * @return ZfcmsComuniSezioni
     */
    public function setLinkMacro($linkMacro)
    {
        $this->linkMacro = $linkMacro;
    
        return $this;
    }

    /**
     * Get linkMacro
     *
     * @return integer 
     */
    public function getLinkMacro()
    {
        return $this->linkMacro;
    }

    /**
     * Set blocco
     *
     * @param integer $blocco
     * @return ZfcmsComuniSezioni
     */
    public function setBlocco($blocco)
    {
        $this->blocco = $blocco;
    
        return $this;
    }

    /**
     * Get blocco
     *
     * @return integer 
     */
    public function getBlocco()
    {
        return $this->blocco;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     * @return ZfcmsComuniSezioni
     */
    public function setAttivo($attivo)
    {
        $this->attivo = $attivo;
    
        return $this;
    }

    /**
     * Get attivo
     *
     * @return integer 
     */
    public function getAttivo()
    {
        return $this->attivo;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return ZfcmsComuniSezioni
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set cssId
     *
     * @param integer $cssId
     * @return ZfcmsComuniSezioni
     */
    public function setCssId($cssId)
    {
        $this->cssId = $cssId;
    
        return $this;
    }

    /**
     * Get cssId
     *
     * @return integer 
     */
    public function getCssId()
    {
        return $this->cssId;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return ZfcmsComuniSezioni
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
     * Set slug
     *
     * @param string $slug
     * @return ZfcmsComuniSezioni
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
     * Set title
     *
     * @param string $title
     * @return ZfcmsComuniSezioni
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
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return ZfcmsComuniSezioni
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
     * @return ZfcmsComuniSezioni
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
     * @return ZfcmsComuniSezioni
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
     * Set isAmmTrasparente
     *
     * @param integer $isAmmTrasparente
     * @return ZfcmsComuniSezioni
     */
    public function setIsAmmTrasparente($isAmmTrasparente)
    {
        $this->isAmmTrasparente = $isAmmTrasparente;
    
        return $this;
    }

    /**
     * Get isAmmTrasparente
     *
     * @return integer 
     */
    public function getIsAmmTrasparente()
    {
        return $this->isAmmTrasparente;
    }

    /**
     * Set showToAll
     *
     * @param integer $showToAll
     * @return ZfcmsComuniSezioni
     */
    public function setShowToAll($showToAll)
    {
        $this->showToAll = $showToAll;
    
        return $this;
    }

    /**
     * Get showToAll
     *
     * @return integer 
     */
    public function getShowToAll()
    {
        return $this->showToAll;
    }

    /**
     * Set lingua
     *
     * @param \Application\Entity\ZfcmsLanguages $lingua
     * @return ZfcmsComuniSezioni
     */
    public function setLingua(\Application\Entity\ZfcmsLanguages $lingua = null)
    {
        $this->lingua = $lingua;
    
        return $this;
    }

    /**
     * Get lingua
     *
     * @return \Application\Entity\ZfcmsLanguages 
     */
    public function getLingua()
    {
        return $this->lingua;
    }

    /**
     * Set modulo
     *
     * @param \Application\Entity\ZfcmsModules $modulo
     * @return ZfcmsComuniSezioni
     */
    public function setModulo(\Application\Entity\ZfcmsModules $modulo = null)
    {
        $this->modulo = $modulo;
    
        return $this;
    }

    /**
     * Get modulo
     *
     * @return \Application\Entity\ZfcmsModules 
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Set utente
     *
     * @param \Application\Entity\ZfcmsUsers $utente
     * @return ZfcmsComuniSezioni
     */
    public function setUtente(\Application\Entity\ZfcmsUsers $utente = null)
    {
        $this->utente = $utente;
    
        return $this;
    }

    /**
     * Get utente
     *
     * @return \Application\Entity\ZfcmsUsers 
     */
    public function getUtente()
    {
        return $this->utente;
    }
}
