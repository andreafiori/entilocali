<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contatti
 *
 * @ORM\Table(name="contatti", indexes={@ORM\Index(name="user_id", columns={"utente_id"})})
 * @ORM\Entity
 */
class Contatti
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
     * @ORM\Column(name="nome", type="string", length=80, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cognome", type="string", length=80, nullable=true)
     */
    private $cognome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=80, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="messaggio", type="text", length=65535, nullable=true)
     */
    private $messaggio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inserimento", type="datetime", nullable=true)
     */
    private $dataInserimento;

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="string", length=50, nullable=true)
     */
    private $formato = 'contact';

    /**
     * @var string
     *
     * @ORM\Column(name="stato", type="string", length=50, nullable=true)
     */
    private $stato;

    /**
     * @var integer
     *
     * @ORM\Column(name="utente_id", type="bigint", nullable=true)
     */
    private $utenteId = '1';



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
     * @return Contatti
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
     * Set cognome
     *
     * @param string $cognome
     *
     * @return Contatti
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    
        return $this;
    }

    /**
     * Get cognome
     *
     * @return string
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contatti
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Contatti
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set messaggio
     *
     * @param string $messaggio
     *
     * @return Contatti
     */
    public function setMessaggio($messaggio)
    {
        $this->messaggio = $messaggio;
    
        return $this;
    }

    /**
     * Get messaggio
     *
     * @return string
     */
    public function getMessaggio()
    {
        return $this->messaggio;
    }

    /**
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     *
     * @return Contatti
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
     * Set formato
     *
     * @param string $formato
     *
     * @return Contatti
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;
    
        return $this;
    }

    /**
     * Get formato
     *
     * @return string
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set stato
     *
     * @param string $stato
     *
     * @return Contatti
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
     * Set utenteId
     *
     * @param integer $utenteId
     *
     * @return Contatti
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
