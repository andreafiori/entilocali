<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lingue
 *
 * @ORM\Table(name="lingue", indexes={@ORM\Index(name="canale_id", columns={"canale_id"}), @ORM\Index(name="abbreviazione3", columns={"abbreviazione3"}), @ORM\Index(name="abbreviazione1", columns={"abbreviazione1"}), @ORM\Index(name="abbreviazione2", columns={"abbreviazione2"})})
 * @ORM\Entity
 */
class Lingue
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
     * @ORM\Column(name="bandiera", type="string", length=60, nullable=false)
     */
    private $bandiera;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=60, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviazione1", type="string", length=60, nullable=false)
     */
    private $abbreviazione1;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviazione2", type="string", length=60, nullable=false)
     */
    private $abbreviazione2;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviazione3", type="string", length=60, nullable=false)
     */
    private $abbreviazione3;

    /**
     * @var integer
     *
     * @ORM\Column(name="predefinita", type="bigint", nullable=false)
     */
    private $predefinita = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="predefinita_backend", type="bigint", nullable=false)
     */
    private $predefinitaBackend = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="encoding", type="string", length=50, nullable=true)
     */
    private $encoding = 'UTF-8';

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="bigint", nullable=false)
     */
    private $attivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="canale_id", type="bigint", nullable=false)
     */
    private $canaleId = '1';



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
     * Set bandiera
     *
     * @param string $bandiera
     * @return Lingue
     */
    public function setBandiera($bandiera)
    {
        $this->bandiera = $bandiera;

        return $this;
    }

    /**
     * Get bandiera
     *
     * @return string 
     */
    public function getBandiera()
    {
        return $this->bandiera;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Lingue
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
     * Set abbreviazione1
     *
     * @param string $abbreviazione1
     * @return Lingue
     */
    public function setAbbreviazione1($abbreviazione1)
    {
        $this->abbreviazione1 = $abbreviazione1;

        return $this;
    }

    /**
     * Get abbreviazione1
     *
     * @return string 
     */
    public function getAbbreviazione1()
    {
        return $this->abbreviazione1;
    }

    /**
     * Set abbreviazione2
     *
     * @param string $abbreviazione2
     * @return Lingue
     */
    public function setAbbreviazione2($abbreviazione2)
    {
        $this->abbreviazione2 = $abbreviazione2;

        return $this;
    }

    /**
     * Get abbreviazione2
     *
     * @return string 
     */
    public function getAbbreviazione2()
    {
        return $this->abbreviazione2;
    }

    /**
     * Set abbreviazione3
     *
     * @param string $abbreviazione3
     * @return Lingue
     */
    public function setAbbreviazione3($abbreviazione3)
    {
        $this->abbreviazione3 = $abbreviazione3;

        return $this;
    }

    /**
     * Get abbreviazione3
     *
     * @return string 
     */
    public function getAbbreviazione3()
    {
        return $this->abbreviazione3;
    }

    /**
     * Set predefinita
     *
     * @param integer $predefinita
     * @return Lingue
     */
    public function setPredefinita($predefinita)
    {
        $this->predefinita = $predefinita;

        return $this;
    }

    /**
     * Get predefinita
     *
     * @return integer 
     */
    public function getPredefinita()
    {
        return $this->predefinita;
    }

    /**
     * Set predefinitaBackend
     *
     * @param integer $predefinitaBackend
     * @return Lingue
     */
    public function setPredefinitaBackend($predefinitaBackend)
    {
        $this->predefinitaBackend = $predefinitaBackend;

        return $this;
    }

    /**
     * Get predefinitaBackend
     *
     * @return integer 
     */
    public function getPredefinitaBackend()
    {
        return $this->predefinitaBackend;
    }

    /**
     * Set encoding
     *
     * @param string $encoding
     * @return Lingue
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Get encoding
     *
     * @return string 
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     * @return Lingue
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
     * Set canaleId
     *
     * @param integer $canaleId
     * @return Lingue
     */
    public function setCanaleId($canaleId)
    {
        $this->canaleId = $canaleId;

        return $this;
    }

    /**
     * Get canaleId
     *
     * @return integer 
     */
    public function getCanaleId()
    {
        return $this->canaleId;
    }
}
