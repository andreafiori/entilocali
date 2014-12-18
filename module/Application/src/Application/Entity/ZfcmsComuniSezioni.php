<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniSezioni
 *
 * @ORM\Table(name="zfcms_comuni_sezioni")
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
     * @var string
     *
     * @ORM\Column(name="lingua", type="string", length=100, nullable=false)
     */
    private $lingua;

    /**
     * @var integer
     *
     * @ORM\Column(name="blocco", type="integer", nullable=false)
     */
    private $blocco;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_modulo", type="integer", nullable=false)
     */
    private $idModulo;

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
     * @ORM\Column(name="id_css", type="integer", nullable=true)
     */
    private $idCss;



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
     *
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
     *
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
     *
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
     * Set lingua
     *
     * @param string $lingua
     *
     * @return ZfcmsComuniSezioni
     */
    public function setLingua($lingua)
    {
        $this->lingua = $lingua;
    
        return $this;
    }

    /**
     * Get lingua
     *
     * @return string
     */
    public function getLingua()
    {
        return $this->lingua;
    }

    /**
     * Set blocco
     *
     * @param integer $blocco
     *
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
     * Set idModulo
     *
     * @param integer $idModulo
     *
     * @return ZfcmsComuniSezioni
     */
    public function setIdModulo($idModulo)
    {
        $this->idModulo = $idModulo;
    
        return $this;
    }

    /**
     * Get idModulo
     *
     * @return integer
     */
    public function getIdModulo()
    {
        return $this->idModulo;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     *
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
     *
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
     * Set idCss
     *
     * @param integer $idCss
     *
     * @return ZfcmsComuniSezioni
     */
    public function setIdCss($idCss)
    {
        $this->idCss = $idCss;
    
        return $this;
    }

    /**
     * Get idCss
     *
     * @return integer
     */
    public function getIdCss()
    {
        return $this->idCss;
    }
}
