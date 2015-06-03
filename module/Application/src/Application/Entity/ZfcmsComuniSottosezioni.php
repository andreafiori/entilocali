<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniSottosezioni
 *
 * @ORM\Table(name="zfcms_comuni_sottosezioni", indexes={@ORM\Index(name="zf_comuni_sottosezioni_profondita_da_self", columns={"profondita_da"}), @ORM\Index(name="profondita_a", columns={"profondita_a"}), @ORM\Index(name="fk_comuni_sottosezioni_users", columns={"utente_id"}), @ORM\Index(name="fk_comuni_sottosezioni_sezioni", columns={"sezione_id"})})
 * @ORM\Entity
 */
class ZfcmsComuniSottosezioni
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
     * @ORM\Column(name="nome", type="text", length=65535, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="immagine", type="text", length=65535, nullable=true)
     */
    private $immagine;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="url_title", type="string", length=100, nullable=true)
     */
    private $urlTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="url_target_blank", type="string", length=5, nullable=true)
     */
    private $urlTargetBlank;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="integer", nullable=false)
     */
    private $posizione;

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo;

    /**
     * @var string
     *
     * @ORM\Column(name="profondita_a", type="string", length=100, nullable=false)
     */
    private $profonditaA;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_ss", type="integer", nullable=false)
     */
    private $isSs;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=80, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=100, nullable=false)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string", length=100, nullable=false)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", length=65535, nullable=false)
     */
    private $seoDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_amm_trasparente", type="integer", nullable=false)
     */
    private $isAmmTrasparente;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_to_all", type="integer", nullable=false)
     */
    private $showToAll;

    /**
     * @var string
     *
     * @ORM\Column(name="template_type", type="string", length=50, nullable=false)
     */
    private $templateType;

    /**
     * @var string
     *
     * @ORM\Column(name="template_file", type="string", length=50, nullable=false)
     */
    private $templateFile;

    /**
     * @var \Application\Entity\ZfcmsComuniSottosezioni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsComuniSottosezioni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profondita_da", referencedColumnName="id")
     * })
     */
    private $profonditaDa;

    /**
     * @var \Application\Entity\ZfcmsComuniSezioni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsComuniSezioni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sezione_id", referencedColumnName="id")
     * })
     */
    private $sezione;

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
     * @return ZfcmsComuniSottosezioni
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
     * Set immagine
     *
     * @param string $immagine
     * @return ZfcmsComuniSottosezioni
     */
    public function setImmagine($immagine)
    {
        $this->immagine = $immagine;
    
        return $this;
    }

    /**
     * Get immagine
     *
     * @return string 
     */
    public function getImmagine()
    {
        return $this->immagine;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return ZfcmsComuniSottosezioni
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
     * Set urlTitle
     *
     * @param string $urlTitle
     * @return ZfcmsComuniSottosezioni
     */
    public function setUrlTitle($urlTitle)
    {
        $this->urlTitle = $urlTitle;
    
        return $this;
    }

    /**
     * Get urlTitle
     *
     * @return string 
     */
    public function getUrlTitle()
    {
        return $this->urlTitle;
    }

    /**
     * Set urlTargetBlank
     *
     * @param string $urlTargetBlank
     * @return ZfcmsComuniSottosezioni
     */
    public function setUrlTargetBlank($urlTargetBlank)
    {
        $this->urlTargetBlank = $urlTargetBlank;
    
        return $this;
    }

    /**
     * Get urlTargetBlank
     *
     * @return string 
     */
    public function getUrlTargetBlank()
    {
        return $this->urlTargetBlank;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return ZfcmsComuniSottosezioni
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
     * Set attivo
     *
     * @param integer $attivo
     * @return ZfcmsComuniSottosezioni
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
     * Set profonditaA
     *
     * @param string $profonditaA
     * @return ZfcmsComuniSottosezioni
     */
    public function setProfonditaA($profonditaA)
    {
        $this->profonditaA = $profonditaA;
    
        return $this;
    }

    /**
     * Get profonditaA
     *
     * @return string 
     */
    public function getProfonditaA()
    {
        return $this->profonditaA;
    }

    /**
     * Set isSs
     *
     * @param integer $isSs
     * @return ZfcmsComuniSottosezioni
     */
    public function setIsSs($isSs)
    {
        $this->isSs = $isSs;
    
        return $this;
    }

    /**
     * Get isSs
     *
     * @return integer 
     */
    public function getIsSs()
    {
        return $this->isSs;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ZfcmsComuniSottosezioni
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
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return ZfcmsComuniSottosezioni
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
     * @return ZfcmsComuniSottosezioni
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
     * @return ZfcmsComuniSottosezioni
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
     * Set isAmmTrasparente
     *
     * @param integer $isAmmTrasparente
     * @return ZfcmsComuniSottosezioni
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
     * @return ZfcmsComuniSottosezioni
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
     * Set templateType
     *
     * @param string $templateType
     * @return ZfcmsComuniSottosezioni
     */
    public function setTemplateType($templateType)
    {
        $this->templateType = $templateType;
    
        return $this;
    }

    /**
     * Get templateType
     *
     * @return string 
     */
    public function getTemplateType()
    {
        return $this->templateType;
    }

    /**
     * Set templateFile
     *
     * @param string $templateFile
     * @return ZfcmsComuniSottosezioni
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
     * Set profonditaDa
     *
     * @param \Application\Entity\ZfcmsComuniSottosezioni $profonditaDa
     * @return ZfcmsComuniSottosezioni
     */
    public function setProfonditaDa(\Application\Entity\ZfcmsComuniSottosezioni $profonditaDa = null)
    {
        $this->profonditaDa = $profonditaDa;
    
        return $this;
    }

    /**
     * Get profonditaDa
     *
     * @return \Application\Entity\ZfcmsComuniSottosezioni 
     */
    public function getProfonditaDa()
    {
        return $this->profonditaDa;
    }

    /**
     * Set sezione
     *
     * @param \Application\Entity\ZfcmsComuniSezioni $sezione
     * @return ZfcmsComuniSottosezioni
     */
    public function setSezione(\Application\Entity\ZfcmsComuniSezioni $sezione = null)
    {
        $this->sezione = $sezione;
    
        return $this;
    }

    /**
     * Get sezione
     *
     * @return \Application\Entity\ZfcmsComuniSezioni 
     */
    public function getSezione()
    {
        return $this->sezione;
    }

    /**
     * Set utente
     *
     * @param \Application\Entity\ZfcmsUsers $utente
     * @return ZfcmsComuniSottosezioni
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
