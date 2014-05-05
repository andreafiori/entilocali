<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utenti
 *
 * @ORM\Table(name="utenti", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="key_ids", columns={"ruolo_id", "nazione", "provincia"})})
 * @ORM\Entity
 */
class Utenti
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
     * @ORM\Column(name="immagine", type="string", length=80, nullable=false)
     */
    private $immagine;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=60, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cognome", type="string", length=60, nullable=false)
     */
    private $cognome;

    /**
     * @var string
     *
     * @ORM\Column(name="indirizzo", type="string", length=60, nullable=false)
     */
    private $indirizzo;

    /**
     * @var string
     *
     * @ORM\Column(name="cap", type="string", length=5, nullable=false)
     */
    private $cap;

    /**
     * @var string
     *
     * @ORM\Column(name="citta", type="string", length=60, nullable=false)
     */
    private $citta;

    /**
     * @var integer
     *
     * @ORM\Column(name="provincia", type="bigint", nullable=false)
     */
    private $provincia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascita", type="datetime", nullable=false)
     */
    private $dataNascita = '1992-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="luogo_nascita", type="string", length=100, nullable=false)
     */
    private $luogoNascita;

    /**
     * @var integer
     *
     * @ORM\Column(name="nazione", type="bigint", nullable=false)
     */
    private $nazione = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="sesso", type="string", nullable=false)
     */
    private $sesso = 'M';

    /**
     * @var string
     *
     * @ORM\Column(name="professione", type="string", length=60, nullable=false)
     */
    private $professione;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=60, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="cellulare", type="string", length=60, nullable=false)
     */
    private $cellulare;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=60, nullable=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="sito_web", type="string", length=80, nullable=false)
     */
    private $sitoWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="codice_fiscale", type="string", length=80, nullable=false)
     */
    private $codiceFiscale;

    /**
     * @var string
     *
     * @ORM\Column(name="partita_iva", type="string", length=60, nullable=false)
     */
    private $partitaIva;

    /**
     * @var string
     *
     * @ORM\Column(name="newsletter", type="string", length=1, nullable=false)
     */
    private $newsletter = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="newsletter_formato", type="string", nullable=false)
     */
    private $newsletterFormato = 'html';

    /**
     * @var string
     *
     * @ORM\Column(name="nome_utente", type="string", length=80, nullable=false)
     */
    private $nomeUtente;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=80, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="stato", type="string", length=100, nullable=false)
     */
    private $stato = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_creazione", type="datetime", nullable=false)
     */
    private $dataCreazione = '2014-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_ultimo_aggiornamento", type="datetime", nullable=false)
     */
    private $dataUltimoAggiornamento = '2014-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="codice_conferma", type="string", length=100, nullable=false)
     */
    private $codiceConferma;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruolo_id", type="bigint", nullable=false)
     */
    private $ruoloId;



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
     * Set immagine
     *
     * @param string $immagine
     *
     * @return Utenti
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Utenti
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
     * @return Utenti
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
     * Set indirizzo
     *
     * @param string $indirizzo
     *
     * @return Utenti
     */
    public function setIndirizzo($indirizzo)
    {
        $this->indirizzo = $indirizzo;
    
        return $this;
    }

    /**
     * Get indirizzo
     *
     * @return string 
     */
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    /**
     * Set cap
     *
     * @param string $cap
     *
     * @return Utenti
     */
    public function setCap($cap)
    {
        $this->cap = $cap;
    
        return $this;
    }

    /**
     * Get cap
     *
     * @return string 
     */
    public function getCap()
    {
        return $this->cap;
    }

    /**
     * Set citta
     *
     * @param string $citta
     *
     * @return Utenti
     */
    public function setCitta($citta)
    {
        $this->citta = $citta;
    
        return $this;
    }

    /**
     * Get citta
     *
     * @return string 
     */
    public function getCitta()
    {
        return $this->citta;
    }

    /**
     * Set provincia
     *
     * @param integer $provincia
     *
     * @return Utenti
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return integer 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set dataNascita
     *
     * @param \DateTime $dataNascita
     *
     * @return Utenti
     */
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;
    
        return $this;
    }

    /**
     * Get dataNascita
     *
     * @return \DateTime 
     */
    public function getDataNascita()
    {
        return $this->dataNascita;
    }

    /**
     * Set luogoNascita
     *
     * @param string $luogoNascita
     *
     * @return Utenti
     */
    public function setLuogoNascita($luogoNascita)
    {
        $this->luogoNascita = $luogoNascita;
    
        return $this;
    }

    /**
     * Get luogoNascita
     *
     * @return string 
     */
    public function getLuogoNascita()
    {
        return $this->luogoNascita;
    }

    /**
     * Set nazione
     *
     * @param integer $nazione
     *
     * @return Utenti
     */
    public function setNazione($nazione)
    {
        $this->nazione = $nazione;
    
        return $this;
    }

    /**
     * Get nazione
     *
     * @return integer 
     */
    public function getNazione()
    {
        return $this->nazione;
    }

    /**
     * Set sesso
     *
     * @param string $sesso
     *
     * @return Utenti
     */
    public function setSesso($sesso)
    {
        $this->sesso = $sesso;
    
        return $this;
    }

    /**
     * Get sesso
     *
     * @return string 
     */
    public function getSesso()
    {
        return $this->sesso;
    }

    /**
     * Set professione
     *
     * @param string $professione
     *
     * @return Utenti
     */
    public function setProfessione($professione)
    {
        $this->professione = $professione;
    
        return $this;
    }

    /**
     * Get professione
     *
     * @return string 
     */
    public function getProfessione()
    {
        return $this->professione;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utenti
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
     * @return Utenti
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
     * Set cellulare
     *
     * @param string $cellulare
     *
     * @return Utenti
     */
    public function setCellulare($cellulare)
    {
        $this->cellulare = $cellulare;
    
        return $this;
    }

    /**
     * Get cellulare
     *
     * @return string 
     */
    public function getCellulare()
    {
        return $this->cellulare;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Utenti
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set sitoWeb
     *
     * @param string $sitoWeb
     *
     * @return Utenti
     */
    public function setSitoWeb($sitoWeb)
    {
        $this->sitoWeb = $sitoWeb;
    
        return $this;
    }

    /**
     * Get sitoWeb
     *
     * @return string 
     */
    public function getSitoWeb()
    {
        return $this->sitoWeb;
    }

    /**
     * Set codiceFiscale
     *
     * @param string $codiceFiscale
     *
     * @return Utenti
     */
    public function setCodiceFiscale($codiceFiscale)
    {
        $this->codiceFiscale = $codiceFiscale;
    
        return $this;
    }

    /**
     * Get codiceFiscale
     *
     * @return string 
     */
    public function getCodiceFiscale()
    {
        return $this->codiceFiscale;
    }

    /**
     * Set partitaIva
     *
     * @param string $partitaIva
     *
     * @return Utenti
     */
    public function setPartitaIva($partitaIva)
    {
        $this->partitaIva = $partitaIva;
    
        return $this;
    }

    /**
     * Get partitaIva
     *
     * @return string 
     */
    public function getPartitaIva()
    {
        return $this->partitaIva;
    }

    /**
     * Set newsletter
     *
     * @param string $newsletter
     *
     * @return Utenti
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    
        return $this;
    }

    /**
     * Get newsletter
     *
     * @return string 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set newsletterFormato
     *
     * @param string $newsletterFormato
     *
     * @return Utenti
     */
    public function setNewsletterFormato($newsletterFormato)
    {
        $this->newsletterFormato = $newsletterFormato;
    
        return $this;
    }

    /**
     * Get newsletterFormato
     *
     * @return string 
     */
    public function getNewsletterFormato()
    {
        return $this->newsletterFormato;
    }

    /**
     * Set nomeUtente
     *
     * @param string $nomeUtente
     *
     * @return Utenti
     */
    public function setNomeUtente($nomeUtente)
    {
        $this->nomeUtente = $nomeUtente;
    
        return $this;
    }

    /**
     * Get nomeUtente
     *
     * @return string 
     */
    public function getNomeUtente()
    {
        return $this->nomeUtente;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Utenti
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set stato
     *
     * @param string $stato
     *
     * @return Utenti
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
     * Set dataCreazione
     *
     * @param \DateTime $dataCreazione
     *
     * @return Utenti
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
     *
     * @return Utenti
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
     * Set codiceConferma
     *
     * @param string $codiceConferma
     *
     * @return Utenti
     */
    public function setCodiceConferma($codiceConferma)
    {
        $this->codiceConferma = $codiceConferma;
    
        return $this;
    }

    /**
     * Get codiceConferma
     *
     * @return string 
     */
    public function getCodiceConferma()
    {
        return $this->codiceConferma;
    }

    /**
     * Set ruoloId
     *
     * @param integer $ruoloId
     *
     * @return Utenti
     */
    public function setRuoloId($ruoloId)
    {
        $this->ruoloId = $ruoloId;
    
        return $this;
    }

    /**
     * Get ruoloId
     *
     * @return integer 
     */
    public function getRuoloId()
    {
        return $this->ruoloId;
    }
}
