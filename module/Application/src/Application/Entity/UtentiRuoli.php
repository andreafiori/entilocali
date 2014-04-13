<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtentiRuoli
 *
 * @ORM\Table(name="utenti_ruoli")
 * @ORM\Entity
 */
class UtentiRuoli
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
     * @ORM\Column(name="nome_ruolo", type="string", length=80, nullable=false)
     */
    private $nomeRuolo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_creazione", type="datetime", nullable=false)
     */
    private $dataCreazione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_ultimo_aggiornamento", type="datetime", nullable=false)
     */
    private $dataUltimoAggiornamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="bigint", nullable=false)
     */
    private $posizione = '0';



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
     * Set nomeRuolo
     *
     * @param string $nomeRuolo
     * @return UtentiRuoli
     */
    public function setNomeRuolo($nomeRuolo)
    {
        $this->nomeRuolo = $nomeRuolo;

        return $this;
    }

    /**
     * Get nomeRuolo
     *
     * @return string 
     */
    public function getNomeRuolo()
    {
        return $this->nomeRuolo;
    }

    /**
     * Set dataCreazione
     *
     * @param \DateTime $dataCreazione
     * @return UtentiRuoli
     */
    public function setDataCreazione($dataCreazione)
    {
        $this->dataCreazione = $dataCreazione;

        return $this;
    }

    /**
     * Get dataCreazione
     *
     * @return \DateTime 
     */
    public function getDataCreazione()
    {
        return $this->dataCreazione;
    }

    /**
     * Set dataUltimoAggiornamento
     *
     * @param \DateTime $dataUltimoAggiornamento
     * @return UtentiRuoli
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

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return UtentiRuoli
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
}
