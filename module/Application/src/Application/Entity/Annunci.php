<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annunci
 *
 * @ORM\Table(name="annunci", indexes={@ORM\Index(name="srchid", columns={"category_id", "quartiere_id", "city_id", "province_id", "region_id", "nazione_id", "user_id"})})
 * @ORM\Entity
 */
class Annunci
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
     * @ORM\Column(name="codeid", type="string", length=150, nullable=false)
     */
    private $codeid;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="string", length=150, nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="testannuncio", type="text", nullable=false)
     */
    private $testannuncio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_insert", type="datetime", nullable=false)
     */
    private $dateInsert = '2011-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publish", type="datetime", nullable=false)
     */
    private $datePublish;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredate", type="datetime", nullable=false)
     */
    private $expiredate = '2011-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="vetrina", type="string", length=50, nullable=false)
     */
    private $vetrina;

    /**
     * @var string
     *
     * @ORM\Column(name="promo", type="string", length=50, nullable=false)
     */
    private $promo = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="eliminato", type="string", nullable=false)
     */
    private $eliminato;

    /**
     * @var string
     *
     * @ORM\Column(name="ipaddress", type="string", length=50, nullable=false)
     */
    private $ipaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="banned", type="string", nullable=false)
     */
    private $banned;

    /**
     * @var string
     *
     * @ORM\Column(name="map_indirizzo", type="string", length=80, nullable=false)
     */
    private $mapIndirizzo;

    /**
     * @var integer
     *
     * @ORM\Column(name="map_nrocivico", type="integer", nullable=false)
     */
    private $mapNrocivico;

    /**
     * @var string
     *
     * @ORM\Column(name="map_cap", type="string", length=80, nullable=false)
     */
    private $mapCap;

    /**
     * @var string
     *
     * @ORM\Column(name="map_prov", type="string", length=80, nullable=false)
     */
    private $mapProv = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="map_citta", type="string", length=80, nullable=false)
     */
    private $mapCitta;

    /**
     * @var string
     *
     * @ORM\Column(name="concessionario", type="string", nullable=false)
     */
    private $concessionario = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="privato_azienda", type="string", nullable=false)
     */
    private $privatoAzienda = 'privato';

    /**
     * @var string
     *
     * @ORM\Column(name="prezzo", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $prezzo = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_ann", type="string", length=80, nullable=false)
     */
    private $telefonoAnn = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_show", type="string", nullable=false)
     */
    private $telefonoShow = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="cercoffro", type="string", nullable=false)
     */
    private $cercoffro;

    /**
     * @var string
     *
     * @ORM\Column(name="cercoffro_on", type="string", nullable=false)
     */
    private $cercoffroOn = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=false)
     */
    private $email = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=80, nullable=false)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=80, nullable=false)
     */
    private $note = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="visits", type="integer", nullable=false)
     */
    private $visits = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nazione_id", type="integer", nullable=false)
     */
    private $nazioneId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="region_id", type="integer", nullable=false)
     */
    private $regionId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="province_id", type="integer", nullable=false)
     */
    private $provinceId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer", nullable=false)
     */
    private $cityId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="quartiere_id", type="integer", nullable=false)
     */
    private $quartiereId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';



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
     * Set codeid
     *
     * @param string $codeid
     * @return Annunci
     */
    public function setCodeid($codeid)
    {
        $this->codeid = $codeid;

        return $this;
    }

    /**
     * Get codeid
     *
     * @return string 
     */
    public function getCodeid()
    {
        return $this->codeid;
    }

    /**
     * Set titolo
     *
     * @param string $titolo
     * @return Annunci
     */
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;

        return $this;
    }

    /**
     * Get titolo
     *
     * @return string 
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * Set testannuncio
     *
     * @param string $testannuncio
     * @return Annunci
     */
    public function setTestannuncio($testannuncio)
    {
        $this->testannuncio = $testannuncio;

        return $this;
    }

    /**
     * Get testannuncio
     *
     * @return string 
     */
    public function getTestannuncio()
    {
        return $this->testannuncio;
    }

    /**
     * Set dateInsert
     *
     * @param \DateTime $dateInsert
     * @return Annunci
     */
    public function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;

        return $this;
    }

    /**
     * Get dateInsert
     *
     * @return \DateTime 
     */
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * Set datePublish
     *
     * @param \DateTime $datePublish
     * @return Annunci
     */
    public function setDatePublish($datePublish)
    {
        $this->datePublish = $datePublish;

        return $this;
    }

    /**
     * Get datePublish
     *
     * @return \DateTime 
     */
    public function getDatePublish()
    {
        return $this->datePublish;
    }

    /**
     * Set expiredate
     *
     * @param \DateTime $expiredate
     * @return Annunci
     */
    public function setExpiredate($expiredate)
    {
        $this->expiredate = $expiredate;

        return $this;
    }

    /**
     * Get expiredate
     *
     * @return \DateTime 
     */
    public function getExpiredate()
    {
        return $this->expiredate;
    }

    /**
     * Set vetrina
     *
     * @param string $vetrina
     * @return Annunci
     */
    public function setVetrina($vetrina)
    {
        $this->vetrina = $vetrina;

        return $this;
    }

    /**
     * Get vetrina
     *
     * @return string 
     */
    public function getVetrina()
    {
        return $this->vetrina;
    }

    /**
     * Set promo
     *
     * @param string $promo
     * @return Annunci
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return string 
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * Set eliminato
     *
     * @param string $eliminato
     * @return Annunci
     */
    public function setEliminato($eliminato)
    {
        $this->eliminato = $eliminato;

        return $this;
    }

    /**
     * Get eliminato
     *
     * @return string 
     */
    public function getEliminato()
    {
        return $this->eliminato;
    }

    /**
     * Set ipaddress
     *
     * @param string $ipaddress
     * @return Annunci
     */
    public function setIpaddress($ipaddress)
    {
        $this->ipaddress = $ipaddress;

        return $this;
    }

    /**
     * Get ipaddress
     *
     * @return string 
     */
    public function getIpaddress()
    {
        return $this->ipaddress;
    }

    /**
     * Set banned
     *
     * @param string $banned
     * @return Annunci
     */
    public function setBanned($banned)
    {
        $this->banned = $banned;

        return $this;
    }

    /**
     * Get banned
     *
     * @return string 
     */
    public function getBanned()
    {
        return $this->banned;
    }

    /**
     * Set mapIndirizzo
     *
     * @param string $mapIndirizzo
     * @return Annunci
     */
    public function setMapIndirizzo($mapIndirizzo)
    {
        $this->mapIndirizzo = $mapIndirizzo;

        return $this;
    }

    /**
     * Get mapIndirizzo
     *
     * @return string 
     */
    public function getMapIndirizzo()
    {
        return $this->mapIndirizzo;
    }

    /**
     * Set mapNrocivico
     *
     * @param integer $mapNrocivico
     * @return Annunci
     */
    public function setMapNrocivico($mapNrocivico)
    {
        $this->mapNrocivico = $mapNrocivico;

        return $this;
    }

    /**
     * Get mapNrocivico
     *
     * @return integer 
     */
    public function getMapNrocivico()
    {
        return $this->mapNrocivico;
    }

    /**
     * Set mapCap
     *
     * @param string $mapCap
     * @return Annunci
     */
    public function setMapCap($mapCap)
    {
        $this->mapCap = $mapCap;

        return $this;
    }

    /**
     * Get mapCap
     *
     * @return string 
     */
    public function getMapCap()
    {
        return $this->mapCap;
    }

    /**
     * Set mapProv
     *
     * @param string $mapProv
     * @return Annunci
     */
    public function setMapProv($mapProv)
    {
        $this->mapProv = $mapProv;

        return $this;
    }

    /**
     * Get mapProv
     *
     * @return string 
     */
    public function getMapProv()
    {
        return $this->mapProv;
    }

    /**
     * Set mapCitta
     *
     * @param string $mapCitta
     * @return Annunci
     */
    public function setMapCitta($mapCitta)
    {
        $this->mapCitta = $mapCitta;

        return $this;
    }

    /**
     * Get mapCitta
     *
     * @return string 
     */
    public function getMapCitta()
    {
        return $this->mapCitta;
    }

    /**
     * Set concessionario
     *
     * @param string $concessionario
     * @return Annunci
     */
    public function setConcessionario($concessionario)
    {
        $this->concessionario = $concessionario;

        return $this;
    }

    /**
     * Get concessionario
     *
     * @return string 
     */
    public function getConcessionario()
    {
        return $this->concessionario;
    }

    /**
     * Set privatoAzienda
     *
     * @param string $privatoAzienda
     * @return Annunci
     */
    public function setPrivatoAzienda($privatoAzienda)
    {
        $this->privatoAzienda = $privatoAzienda;

        return $this;
    }

    /**
     * Get privatoAzienda
     *
     * @return string 
     */
    public function getPrivatoAzienda()
    {
        return $this->privatoAzienda;
    }

    /**
     * Set prezzo
     *
     * @param string $prezzo
     * @return Annunci
     */
    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;

        return $this;
    }

    /**
     * Get prezzo
     *
     * @return string 
     */
    public function getPrezzo()
    {
        return $this->prezzo;
    }

    /**
     * Set telefonoAnn
     *
     * @param string $telefonoAnn
     * @return Annunci
     */
    public function setTelefonoAnn($telefonoAnn)
    {
        $this->telefonoAnn = $telefonoAnn;

        return $this;
    }

    /**
     * Get telefonoAnn
     *
     * @return string 
     */
    public function getTelefonoAnn()
    {
        return $this->telefonoAnn;
    }

    /**
     * Set telefonoShow
     *
     * @param string $telefonoShow
     * @return Annunci
     */
    public function setTelefonoShow($telefonoShow)
    {
        $this->telefonoShow = $telefonoShow;

        return $this;
    }

    /**
     * Get telefonoShow
     *
     * @return string 
     */
    public function getTelefonoShow()
    {
        return $this->telefonoShow;
    }

    /**
     * Set cercoffro
     *
     * @param string $cercoffro
     * @return Annunci
     */
    public function setCercoffro($cercoffro)
    {
        $this->cercoffro = $cercoffro;

        return $this;
    }

    /**
     * Get cercoffro
     *
     * @return string 
     */
    public function getCercoffro()
    {
        return $this->cercoffro;
    }

    /**
     * Set cercoffroOn
     *
     * @param string $cercoffroOn
     * @return Annunci
     */
    public function setCercoffroOn($cercoffroOn)
    {
        $this->cercoffroOn = $cercoffroOn;

        return $this;
    }

    /**
     * Get cercoffroOn
     *
     * @return string 
     */
    public function getCercoffroOn()
    {
        return $this->cercoffroOn;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Annunci
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
     * Set contact
     *
     * @param string $contact
     * @return Annunci
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Annunci
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set visits
     *
     * @param integer $visits
     * @return Annunci
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;

        return $this;
    }

    /**
     * Get visits
     *
     * @return integer 
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Annunci
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

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Annunci
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set nazioneId
     *
     * @param integer $nazioneId
     * @return Annunci
     */
    public function setNazioneId($nazioneId)
    {
        $this->nazioneId = $nazioneId;

        return $this;
    }

    /**
     * Get nazioneId
     *
     * @return integer 
     */
    public function getNazioneId()
    {
        return $this->nazioneId;
    }

    /**
     * Set regionId
     *
     * @param integer $regionId
     * @return Annunci
     */
    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;

        return $this;
    }

    /**
     * Get regionId
     *
     * @return integer 
     */
    public function getRegionId()
    {
        return $this->regionId;
    }

    /**
     * Set provinceId
     *
     * @param integer $provinceId
     * @return Annunci
     */
    public function setProvinceId($provinceId)
    {
        $this->provinceId = $provinceId;

        return $this;
    }

    /**
     * Get provinceId
     *
     * @return integer 
     */
    public function getProvinceId()
    {
        return $this->provinceId;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     * @return Annunci
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer 
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set quartiereId
     *
     * @param integer $quartiereId
     * @return Annunci
     */
    public function setQuartiereId($quartiereId)
    {
        $this->quartiereId = $quartiereId;

        return $this;
    }

    /**
     * Get quartiereId
     *
     * @return integer 
     */
    public function getQuartiereId()
    {
        return $this->quartiereId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Annunci
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
}
