<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqRisposte
 *
 * @ORM\Table(name="faq_risposte", indexes={@ORM\Index(name="utente_id", columns={"utente_id"}), @ORM\Index(name="domanda_id", columns={"domanda_id"})})
 * @ORM\Entity
 */
class FaqRisposte
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
     * @ORM\Column(name="risposta", type="text", nullable=false)
     */
    private $risposta;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="bigint", nullable=false)
     */
    private $rate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inserimento", type="datetime", nullable=false)
     */
    private $dataInserimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_ultimo_aggiornamento", type="datetime", nullable=false)
     */
    private $dataUltimoAggiornamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="domanda_id", type="bigint", nullable=false)
     */
    private $domandaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="utente_id", type="bigint", nullable=false)
     */
    private $utenteId;



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
     * Set risposta
     *
     * @param string $risposta
     * @return FaqRisposte
     */
    public function setRisposta($risposta)
    {
        $this->risposta = $risposta;

        return $this;
    }

    /**
     * Get risposta
     *
     * @return string 
     */
    public function getRisposta()
    {
        return $this->risposta;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     * @return FaqRisposte
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     * @return FaqRisposte
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
     * @return FaqRisposte
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
     * Set domandaId
     *
     * @param integer $domandaId
     * @return FaqRisposte
     */
    public function setDomandaId($domandaId)
    {
        $this->domandaId = $domandaId;

        return $this;
    }

    /**
     * Get domandaId
     *
     * @return integer 
     */
    public function getDomandaId()
    {
        return $this->domandaId;
    }

    /**
     * Set utenteId
     *
     * @param integer $utenteId
     * @return FaqRisposte
     */
    public function setUtenteId($utenteId)
    {
        $this->utenteId = $utenteId;

        return $this;
    }

    /**
     * Get utenteId
     *
     * @return integer 
     */
    public function getUtenteId()
    {
        return $this->utenteId;
    }
}
