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
     * @var \Application\Entity\FaqDomande
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\FaqDomande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="domanda_id", referencedColumnName="id")
     * })
     */
    private $domanda;

    /**
     * @var \Application\Entity\Utenti
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Utenti")
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
     * Set risposta
     *
     * @param string $risposta
     *
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
     *
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
     *
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
     *
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
     * Set domanda
     *
     * @param \Application\Entity\FaqDomande $domanda
     *
     * @return FaqRisposte
     */
    public function setDomanda(\Application\Entity\FaqDomande $domanda = null)
    {
        $this->domanda = $domanda;
    
        return $this;
    }

    /**
     * Get domanda
     *
     * @return \Application\Entity\FaqDomande 
     */
    public function getDomanda()
    {
        return $this->domanda;
    }

    /**
     * Set utente
     *
     * @param \Application\Entity\Utenti $utente
     *
     * @return FaqRisposte
     */
    public function setUtente(\Application\Entity\Utenti $utente = null)
    {
        $this->utente = $utente;
    
        return $this;
    }

    /**
     * Get utente
     *
     * @return \Application\Entity\Utenti 
     */
    public function getUtente()
    {
        return $this->utente;
    }
}
