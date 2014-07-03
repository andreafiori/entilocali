<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContpubAllegati
 *
 * @ORM\Table(name="zfcms_comuni_contpub_allegati")
 * @ORM\Entity
 */
class ZfcmsComuniContpubAllegati
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
     * @var integer
     *
     * @ORM\Column(name="id_contpub", type="integer", nullable=false)
     */
    private $idContpub;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="text", length=65535, nullable=false)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_mime", type="integer", nullable=false)
     */
    private $idMime;

    /**
     * @var string
     *
     * @ORM\Column(name="dati", type="blob", nullable=false)
     */
    private $dati;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="integer", nullable=false)
     */
    private $posizione;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="text", length=65535, nullable=false)
     */
    private $size;

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria", type="integer", nullable=false)
     */
    private $categoria = '0';



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
     * Set idContpub
     *
     * @param integer $idContpub
     *
     * @return ZfcmsComuniContpubAllegati
     */
    public function setIdContpub($idContpub)
    {
        $this->idContpub = $idContpub;
    
        return $this;
    }

    /**
     * Get idContpub
     *
     * @return integer
     */
    public function getIdContpub()
    {
        return $this->idContpub;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return ZfcmsComuniContpubAllegati
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
     * Set idMime
     *
     * @param integer $idMime
     *
     * @return ZfcmsComuniContpubAllegati
     */
    public function setIdMime($idMime)
    {
        $this->idMime = $idMime;
    
        return $this;
    }

    /**
     * Get idMime
     *
     * @return integer
     */
    public function getIdMime()
    {
        return $this->idMime;
    }

    /**
     * Set dati
     *
     * @param string $dati
     *
     * @return ZfcmsComuniContpubAllegati
     */
    public function setDati($dati)
    {
        $this->dati = $dati;
    
        return $this;
    }

    /**
     * Get dati
     *
     * @return string
     */
    public function getDati()
    {
        return $this->dati;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     *
     * @return ZfcmsComuniContpubAllegati
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
     * Set size
     *
     * @param string $size
     *
     * @return ZfcmsComuniContpubAllegati
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set categoria
     *
     * @param integer $categoria
     *
     * @return ZfcmsComuniContpubAllegati
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}
