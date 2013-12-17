<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LottoIvg
 *
 * @ORM\Table(name="lotto_ivg")
 * @ORM\Entity
 */
class LottoIvg
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
     * @ORM\Column(name="citta", type="string", length=80, nullable=false)
     */
    private $citta;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=60, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="indirizzosede", type="string", length=60, nullable=false)
     */
    private $indirizzosede;

    /**
     * @var string
     *
     * @ORM\Column(name="cap", type="string", length=10, nullable=false)
     */
    private $cap;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=11, nullable=false)
     */
    private $province = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="regione", type="string", length=11, nullable=false)
     */
    private $regione = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="direttore", type="string", length=100, nullable=false)
     */
    private $direttore;

    /**
     * @var string
     *
     * @ORM\Column(name="amministratore", type="string", length=100, nullable=false)
     */
    private $amministratore;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabcommamm", type="string", length=100, nullable=false)
     */
    private $responsabcommamm;

    /**
     * @var string
     *
     * @ORM\Column(name="referente", type="string", length=100, nullable=false)
     */
    private $referente;

    /**
     * @var string
     *
     * @ORM\Column(name="emailivg", type="string", length=60, nullable=false)
     */
    private $emailivg;

    /**
     * @var string
     *
     * @ORM\Column(name="emailmob", type="string", length=100, nullable=false)
     */
    private $emailmob;

    /**
     * @var string
     *
     * @ORM\Column(name="emailimmob", type="string", length=100, nullable=false)
     */
    private $emailimmob;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoivg", type="string", length=100, nullable=false)
     */
    private $telefonoivg;

    /**
     * @var string
     *
     * @ORM\Column(name="faxivg", type="string", length=100, nullable=false)
     */
    private $faxivg;

    /**
     * @var string
     *
     * @ORM\Column(name="urlsito", type="string", length=80, nullable=false)
     */
    private $urlsito;

    /**
     * @var string
     *
     * @ORM\Column(name="distretto", type="string", length=150, nullable=false)
     */
    private $distretto;

    /**
     * @var string
     *
     * @ORM\Column(name="orariolavoro", type="text", nullable=false)
     */
    private $orariolavoro;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;



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
     * Set citta
     *
     * @param string $citta
     * @return LottoIvg
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
     * Set nome
     *
     * @param string $nome
     * @return LottoIvg
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
     * Set indirizzosede
     *
     * @param string $indirizzosede
     * @return LottoIvg
     */
    public function setIndirizzosede($indirizzosede)
    {
        $this->indirizzosede = $indirizzosede;

        return $this;
    }

    /**
     * Get indirizzosede
     *
     * @return string 
     */
    public function getIndirizzosede()
    {
        return $this->indirizzosede;
    }

    /**
     * Set cap
     *
     * @param string $cap
     * @return LottoIvg
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
     * Set province
     *
     * @param string $province
     * @return LottoIvg
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set regione
     *
     * @param string $regione
     * @return LottoIvg
     */
    public function setRegione($regione)
    {
        $this->regione = $regione;

        return $this;
    }

    /**
     * Get regione
     *
     * @return string 
     */
    public function getRegione()
    {
        return $this->regione;
    }

    /**
     * Set direttore
     *
     * @param string $direttore
     * @return LottoIvg
     */
    public function setDirettore($direttore)
    {
        $this->direttore = $direttore;

        return $this;
    }

    /**
     * Get direttore
     *
     * @return string 
     */
    public function getDirettore()
    {
        return $this->direttore;
    }

    /**
     * Set amministratore
     *
     * @param string $amministratore
     * @return LottoIvg
     */
    public function setAmministratore($amministratore)
    {
        $this->amministratore = $amministratore;

        return $this;
    }

    /**
     * Get amministratore
     *
     * @return string 
     */
    public function getAmministratore()
    {
        return $this->amministratore;
    }

    /**
     * Set responsabcommamm
     *
     * @param string $responsabcommamm
     * @return LottoIvg
     */
    public function setResponsabcommamm($responsabcommamm)
    {
        $this->responsabcommamm = $responsabcommamm;

        return $this;
    }

    /**
     * Get responsabcommamm
     *
     * @return string 
     */
    public function getResponsabcommamm()
    {
        return $this->responsabcommamm;
    }

    /**
     * Set referente
     *
     * @param string $referente
     * @return LottoIvg
     */
    public function setReferente($referente)
    {
        $this->referente = $referente;

        return $this;
    }

    /**
     * Get referente
     *
     * @return string 
     */
    public function getReferente()
    {
        return $this->referente;
    }

    /**
     * Set emailivg
     *
     * @param string $emailivg
     * @return LottoIvg
     */
    public function setEmailivg($emailivg)
    {
        $this->emailivg = $emailivg;

        return $this;
    }

    /**
     * Get emailivg
     *
     * @return string 
     */
    public function getEmailivg()
    {
        return $this->emailivg;
    }

    /**
     * Set emailmob
     *
     * @param string $emailmob
     * @return LottoIvg
     */
    public function setEmailmob($emailmob)
    {
        $this->emailmob = $emailmob;

        return $this;
    }

    /**
     * Get emailmob
     *
     * @return string 
     */
    public function getEmailmob()
    {
        return $this->emailmob;
    }

    /**
     * Set emailimmob
     *
     * @param string $emailimmob
     * @return LottoIvg
     */
    public function setEmailimmob($emailimmob)
    {
        $this->emailimmob = $emailimmob;

        return $this;
    }

    /**
     * Get emailimmob
     *
     * @return string 
     */
    public function getEmailimmob()
    {
        return $this->emailimmob;
    }

    /**
     * Set telefonoivg
     *
     * @param string $telefonoivg
     * @return LottoIvg
     */
    public function setTelefonoivg($telefonoivg)
    {
        $this->telefonoivg = $telefonoivg;

        return $this;
    }

    /**
     * Get telefonoivg
     *
     * @return string 
     */
    public function getTelefonoivg()
    {
        return $this->telefonoivg;
    }

    /**
     * Set faxivg
     *
     * @param string $faxivg
     * @return LottoIvg
     */
    public function setFaxivg($faxivg)
    {
        $this->faxivg = $faxivg;

        return $this;
    }

    /**
     * Get faxivg
     *
     * @return string 
     */
    public function getFaxivg()
    {
        return $this->faxivg;
    }

    /**
     * Set urlsito
     *
     * @param string $urlsito
     * @return LottoIvg
     */
    public function setUrlsito($urlsito)
    {
        $this->urlsito = $urlsito;

        return $this;
    }

    /**
     * Get urlsito
     *
     * @return string 
     */
    public function getUrlsito()
    {
        return $this->urlsito;
    }

    /**
     * Set distretto
     *
     * @param string $distretto
     * @return LottoIvg
     */
    public function setDistretto($distretto)
    {
        $this->distretto = $distretto;

        return $this;
    }

    /**
     * Get distretto
     *
     * @return string 
     */
    public function getDistretto()
    {
        return $this->distretto;
    }

    /**
     * Set orariolavoro
     *
     * @param string $orariolavoro
     * @return LottoIvg
     */
    public function setOrariolavoro($orariolavoro)
    {
        $this->orariolavoro = $orariolavoro;

        return $this;
    }

    /**
     * Get orariolavoro
     *
     * @return string 
     */
    public function getOrariolavoro()
    {
        return $this->orariolavoro;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return LottoIvg
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
