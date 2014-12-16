<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniSottosezioni
 *
 * @ORM\Table(name="zfcms_comuni_sottosezioni", indexes={@ORM\Index(name="sezione_id", columns={"sezione_id"})})
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
     * @var integer
     *
     * @ORM\Column(name="sezione_id", type="bigint", nullable=false)
     */
    private $sezioneId;

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
     * @ORM\Column(name="profondita_da", type="integer", nullable=false)
     */
    private $profonditaDa;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_ss", type="integer", nullable=false)
     */
    private $isSs;



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
     * Set sezioneId
     *
     * @param integer $sezioneId
     *
     * @return ZfcmsComuniSottosezioni
     */
    public function setSezioneId($sezioneId)
    {
        $this->sezioneId = $sezioneId;
    
        return $this;
    }

    /**
     * Get sezioneId
     *
     * @return integer
     */
    public function getSezioneId()
    {
        return $this->sezioneId;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
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
     *
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
     *
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
     * Set posizione
     *
     * @param integer $posizione
     *
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
     *
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
     *
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
     * Set profonditaDa
     *
     * @param integer $profonditaDa
     *
     * @return ZfcmsComuniSottosezioni
     */
    public function setProfonditaDa($profonditaDa)
    {
        $this->profonditaDa = $profonditaDa;
    
        return $this;
    }

    /**
     * Get profonditaDa
     *
     * @return integer
     */
    public function getProfonditaDa()
    {
        return $this->profonditaDa;
    }

    /**
     * Set isSs
     *
     * @param integer $isSs
     *
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
}
