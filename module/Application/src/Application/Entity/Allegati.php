<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Allegati
 *
 * @ORM\Table(name="allegati")
 * @ORM\Entity
 */
class Allegati
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
     * @ORM\Column(name="nome_file", type="string", length=100, nullable=false)
     */
    private $nomeFile;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_file", type="string", length=100, nullable=false)
     */
    private $tipoFile;

    /**
     * @var string
     *
     * @ORM\Column(name="dimensione_file", type="string", length=60, nullable=false)
     */
    private $dimensioneFile;

    /**
     * @var string
     *
     * @ORM\Column(name="stato", type="string", length=50, nullable=true)
     */
    private $stato;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inserimento", type="datetime", nullable=false)
     */
    private $dataInserimento = '2013-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_ultimo_aggiornamento", type="datetime", nullable=false)
     */
    private $dataUltimoAggiornamento = '2013-01-01 01:01:01';



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
     * Set nomeFile
     *
     * @param string $nomeFile
     * @return Allegati
     */
    public function setNomeFile($nomeFile)
    {
        $this->nomeFile = $nomeFile;

        return $this;
    }

    /**
     * Get nomeFile
     *
     * @return string 
     */
    public function getNomeFile()
    {
        return $this->nomeFile;
    }

    /**
     * Set tipoFile
     *
     * @param string $tipoFile
     * @return Allegati
     */
    public function setTipoFile($tipoFile)
    {
        $this->tipoFile = $tipoFile;

        return $this;
    }

    /**
     * Get tipoFile
     *
     * @return string 
     */
    public function getTipoFile()
    {
        return $this->tipoFile;
    }

    /**
     * Set dimensioneFile
     *
     * @param string $dimensioneFile
     * @return Allegati
     */
    public function setDimensioneFile($dimensioneFile)
    {
        $this->dimensioneFile = $dimensioneFile;

        return $this;
    }

    /**
     * Get dimensioneFile
     *
     * @return string 
     */
    public function getDimensioneFile()
    {
        return $this->dimensioneFile;
    }

    /**
     * Set stato
     *
     * @param string $stato
     * @return Allegati
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
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     * @return Allegati
     */
    public function setDataInserimento($dataInserimento)
    {
        $this->dataInserimento = $dataInserimento;

        return $this;
    }

    /**
     * Get dataInserimento
     *
     * @return \DateTime 
     */
    public function getDataInserimento()
    {
        return $this->dataInserimento;
    }

    /**
     * Set dataUltimoAggiornamento
     *
     * @param \DateTime $dataUltimoAggiornamento
     * @return Allegati
     */
    public function setDataUltimoAggiornamento($dataUltimoAggiornamento)
    {
        $this->dataUltimoAggiornamento = $dataUltimoAggiornamento;

        return $this;
    }

    /**
     * Get dataUltimoAggiornamento
     *
     * @return \DateTime 
     */
    public function getDataUltimoAggiornamento()
    {
        return $this->dataUltimoAggiornamento;
    }
}
