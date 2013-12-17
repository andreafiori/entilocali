<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LottoVendite
 *
 * @ORM\Table(name="lotto_vendite")
 * @ORM\Entity
 */
class LottoVendite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idvend", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvend;

    /**
     * @var string
     *
     * @ORM\Column(name="intestass", type="string", length=60, nullable=false)
     */
    private $intestass = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="fndspes", type="decimal", precision=60, scale=2, nullable=false)
     */
    private $fndspes = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="prezzobase", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $prezzobase = '0.00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="domanda_data", type="datetime", nullable=false)
     */
    private $domandaData = '2012-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="domanda_luogo", type="string", length=100, nullable=false)
     */
    private $domandaLuogo;

    /**
     * @var string
     *
     * @ORM\Column(name="domanda_baseasta", type="decimal", precision=60, scale=2, nullable=false)
     */
    private $domandaBaseasta = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="domanda_przstima", type="decimal", precision=60, scale=2, nullable=false)
     */
    private $domandaPrzstima = '0.00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="asta_dataora", type="datetime", nullable=false)
     */
    private $astaDataora = '2012-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="asta_luogo", type="string", length=60, nullable=false)
     */
    private $astaLuogo;

    /**
     * @var string
     *
     * @ORM\Column(name="asta_giudice", type="string", length=100, nullable=false)
     */
    private $astaGiudice;

    /**
     * @var string
     *
     * @ORM\Column(name="cauzione", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $cauzione = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="fondospesa", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $fondospesa = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="intestatario_assegni", type="string", length=100, nullable=false)
     */
    private $intestatarioAssegni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="termine_saldo", type="datetime", nullable=false)
     */
    private $termineSaldo = '2007-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="rialzominimo_solo_snz_incanto", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $rialzominimoSoloSnzIncanto = '1000.00';

    /**
     * @var string
     *
     * @ORM\Column(name="regole", type="text", nullable=false)
     */
    private $regole;

    /**
     * @var string
     *
     * @ORM\Column(name="guida", type="text", nullable=false)
     */
    private $guida;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="esito_bando", type="string", nullable=false)
     */
    private $esitoBando = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="esito", type="string", length=60, nullable=false)
     */
    private $esito;

    /**
     * @var string
     *
     * @ORM\Column(name="firmatario", type="string", length=100, nullable=false)
     */
    private $firmatario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_rinvio", type="datetime", nullable=false)
     */
    private $dataRinvio = '2007-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datascadenza2", type="datetime", nullable=false)
     */
    private $datascadenza2 = '2007-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataorasta2", type="datetime", nullable=false)
     */
    private $dataorasta2 = '2007-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="prezzo_aggiudicatario", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $prezzoAggiudicatario = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="nuovo_prezzobase", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $nuovoPrezzobase = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="nuova_modalitavendita", type="string", length=100, nullable=false)
     */
    private $nuovaModalitavendita = '60';

    /**
     * @var string
     *
     * @ORM\Column(name="oneri_bolli", type="string", length=100, nullable=false)
     */
    private $oneriBolli;

    /**
     * @var string
     *
     * @ORM\Column(name="oneri_tassaregistro", type="string", length=100, nullable=false)
     */
    private $oneriTassaregistro;

    /**
     * @var string
     *
     * @ORM\Column(name="oneri_iva", type="string", length=100, nullable=false)
     */
    private $oneriIva;

    /**
     * @var string
     *
     * @ORM\Column(name="oneri_speseaccessorie", type="string", length=100, nullable=false)
     */
    private $oneriSpeseaccessorie;

    /**
     * @var string
     *
     * @ORM\Column(name="oneri_dirittiasta", type="string", length=100, nullable=false)
     */
    private $oneriDirittiasta;

    /**
     * @var string
     *
     * @ORM\Column(name="oneri_ivadirittiasta", type="string", length=100, nullable=false)
     */
    private $oneriIvadirittiasta;

    /**
     * @var integer
     *
     * @ORM\Column(name="rif_ivg", type="integer", nullable=false)
     */
    private $rifIvg = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rif_tribunale", type="integer", nullable=false)
     */
    private $rifTribunale = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifproc_vendita", type="integer", nullable=false)
     */
    private $rifprocVendita = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="riflotto_vendita", type="integer", nullable=false)
     */
    private $riflottoVendita = '0';



    /**
     * Get idvend
     *
     * @return integer 
     */
    public function getIdvend()
    {
        return $this->idvend;
    }

    /**
     * Set intestass
     *
     * @param string $intestass
     * @return LottoVendite
     */
    public function setIntestass($intestass)
    {
        $this->intestass = $intestass;

        return $this;
    }

    /**
     * Get intestass
     *
     * @return string 
     */
    public function getIntestass()
    {
        return $this->intestass;
    }

    /**
     * Set fndspes
     *
     * @param string $fndspes
     * @return LottoVendite
     */
    public function setFndspes($fndspes)
    {
        $this->fndspes = $fndspes;

        return $this;
    }

    /**
     * Get fndspes
     *
     * @return string 
     */
    public function getFndspes()
    {
        return $this->fndspes;
    }

    /**
     * Set prezzobase
     *
     * @param string $prezzobase
     * @return LottoVendite
     */
    public function setPrezzobase($prezzobase)
    {
        $this->prezzobase = $prezzobase;

        return $this;
    }

    /**
     * Get prezzobase
     *
     * @return string 
     */
    public function getPrezzobase()
    {
        return $this->prezzobase;
    }

    /**
     * Set domandaData
     *
     * @param \DateTime $domandaData
     * @return LottoVendite
     */
    public function setDomandaData($domandaData)
    {
        $this->domandaData = $domandaData;

        return $this;
    }

    /**
     * Get domandaData
     *
     * @return \DateTime 
     */
    public function getDomandaData()
    {
        return $this->domandaData;
    }

    /**
     * Set domandaLuogo
     *
     * @param string $domandaLuogo
     * @return LottoVendite
     */
    public function setDomandaLuogo($domandaLuogo)
    {
        $this->domandaLuogo = $domandaLuogo;

        return $this;
    }

    /**
     * Get domandaLuogo
     *
     * @return string 
     */
    public function getDomandaLuogo()
    {
        return $this->domandaLuogo;
    }

    /**
     * Set domandaBaseasta
     *
     * @param string $domandaBaseasta
     * @return LottoVendite
     */
    public function setDomandaBaseasta($domandaBaseasta)
    {
        $this->domandaBaseasta = $domandaBaseasta;

        return $this;
    }

    /**
     * Get domandaBaseasta
     *
     * @return string 
     */
    public function getDomandaBaseasta()
    {
        return $this->domandaBaseasta;
    }

    /**
     * Set domandaPrzstima
     *
     * @param string $domandaPrzstima
     * @return LottoVendite
     */
    public function setDomandaPrzstima($domandaPrzstima)
    {
        $this->domandaPrzstima = $domandaPrzstima;

        return $this;
    }

    /**
     * Get domandaPrzstima
     *
     * @return string 
     */
    public function getDomandaPrzstima()
    {
        return $this->domandaPrzstima;
    }

    /**
     * Set astaDataora
     *
     * @param \DateTime $astaDataora
     * @return LottoVendite
     */
    public function setAstaDataora($astaDataora)
    {
        $this->astaDataora = $astaDataora;

        return $this;
    }

    /**
     * Get astaDataora
     *
     * @return \DateTime 
     */
    public function getAstaDataora()
    {
        return $this->astaDataora;
    }

    /**
     * Set astaLuogo
     *
     * @param string $astaLuogo
     * @return LottoVendite
     */
    public function setAstaLuogo($astaLuogo)
    {
        $this->astaLuogo = $astaLuogo;

        return $this;
    }

    /**
     * Get astaLuogo
     *
     * @return string 
     */
    public function getAstaLuogo()
    {
        return $this->astaLuogo;
    }

    /**
     * Set astaGiudice
     *
     * @param string $astaGiudice
     * @return LottoVendite
     */
    public function setAstaGiudice($astaGiudice)
    {
        $this->astaGiudice = $astaGiudice;

        return $this;
    }

    /**
     * Get astaGiudice
     *
     * @return string 
     */
    public function getAstaGiudice()
    {
        return $this->astaGiudice;
    }

    /**
     * Set cauzione
     *
     * @param string $cauzione
     * @return LottoVendite
     */
    public function setCauzione($cauzione)
    {
        $this->cauzione = $cauzione;

        return $this;
    }

    /**
     * Get cauzione
     *
     * @return string 
     */
    public function getCauzione()
    {
        return $this->cauzione;
    }

    /**
     * Set fondospesa
     *
     * @param string $fondospesa
     * @return LottoVendite
     */
    public function setFondospesa($fondospesa)
    {
        $this->fondospesa = $fondospesa;

        return $this;
    }

    /**
     * Get fondospesa
     *
     * @return string 
     */
    public function getFondospesa()
    {
        return $this->fondospesa;
    }

    /**
     * Set intestatarioAssegni
     *
     * @param string $intestatarioAssegni
     * @return LottoVendite
     */
    public function setIntestatarioAssegni($intestatarioAssegni)
    {
        $this->intestatarioAssegni = $intestatarioAssegni;

        return $this;
    }

    /**
     * Get intestatarioAssegni
     *
     * @return string 
     */
    public function getIntestatarioAssegni()
    {
        return $this->intestatarioAssegni;
    }

    /**
     * Set termineSaldo
     *
     * @param \DateTime $termineSaldo
     * @return LottoVendite
     */
    public function setTermineSaldo($termineSaldo)
    {
        $this->termineSaldo = $termineSaldo;

        return $this;
    }

    /**
     * Get termineSaldo
     *
     * @return \DateTime 
     */
    public function getTermineSaldo()
    {
        return $this->termineSaldo;
    }

    /**
     * Set rialzominimoSoloSnzIncanto
     *
     * @param string $rialzominimoSoloSnzIncanto
     * @return LottoVendite
     */
    public function setRialzominimoSoloSnzIncanto($rialzominimoSoloSnzIncanto)
    {
        $this->rialzominimoSoloSnzIncanto = $rialzominimoSoloSnzIncanto;

        return $this;
    }

    /**
     * Get rialzominimoSoloSnzIncanto
     *
     * @return string 
     */
    public function getRialzominimoSoloSnzIncanto()
    {
        return $this->rialzominimoSoloSnzIncanto;
    }

    /**
     * Set regole
     *
     * @param string $regole
     * @return LottoVendite
     */
    public function setRegole($regole)
    {
        $this->regole = $regole;

        return $this;
    }

    /**
     * Get regole
     *
     * @return string 
     */
    public function getRegole()
    {
        return $this->regole;
    }

    /**
     * Set guida
     *
     * @param string $guida
     * @return LottoVendite
     */
    public function setGuida($guida)
    {
        $this->guida = $guida;

        return $this;
    }

    /**
     * Get guida
     *
     * @return string 
     */
    public function getGuida()
    {
        return $this->guida;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return LottoVendite
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
     * Set esitoBando
     *
     * @param string $esitoBando
     * @return LottoVendite
     */
    public function setEsitoBando($esitoBando)
    {
        $this->esitoBando = $esitoBando;

        return $this;
    }

    /**
     * Get esitoBando
     *
     * @return string 
     */
    public function getEsitoBando()
    {
        return $this->esitoBando;
    }

    /**
     * Set esito
     *
     * @param string $esito
     * @return LottoVendite
     */
    public function setEsito($esito)
    {
        $this->esito = $esito;

        return $this;
    }

    /**
     * Get esito
     *
     * @return string 
     */
    public function getEsito()
    {
        return $this->esito;
    }

    /**
     * Set firmatario
     *
     * @param string $firmatario
     * @return LottoVendite
     */
    public function setFirmatario($firmatario)
    {
        $this->firmatario = $firmatario;

        return $this;
    }

    /**
     * Get firmatario
     *
     * @return string 
     */
    public function getFirmatario()
    {
        return $this->firmatario;
    }

    /**
     * Set dataRinvio
     *
     * @param \DateTime $dataRinvio
     * @return LottoVendite
     */
    public function setDataRinvio($dataRinvio)
    {
        $this->dataRinvio = $dataRinvio;

        return $this;
    }

    /**
     * Get dataRinvio
     *
     * @return \DateTime 
     */
    public function getDataRinvio()
    {
        return $this->dataRinvio;
    }

    /**
     * Set datascadenza2
     *
     * @param \DateTime $datascadenza2
     * @return LottoVendite
     */
    public function setDatascadenza2($datascadenza2)
    {
        $this->datascadenza2 = $datascadenza2;

        return $this;
    }

    /**
     * Get datascadenza2
     *
     * @return \DateTime 
     */
    public function getDatascadenza2()
    {
        return $this->datascadenza2;
    }

    /**
     * Set dataorasta2
     *
     * @param \DateTime $dataorasta2
     * @return LottoVendite
     */
    public function setDataorasta2($dataorasta2)
    {
        $this->dataorasta2 = $dataorasta2;

        return $this;
    }

    /**
     * Get dataorasta2
     *
     * @return \DateTime 
     */
    public function getDataorasta2()
    {
        return $this->dataorasta2;
    }

    /**
     * Set prezzoAggiudicatario
     *
     * @param string $prezzoAggiudicatario
     * @return LottoVendite
     */
    public function setPrezzoAggiudicatario($prezzoAggiudicatario)
    {
        $this->prezzoAggiudicatario = $prezzoAggiudicatario;

        return $this;
    }

    /**
     * Get prezzoAggiudicatario
     *
     * @return string 
     */
    public function getPrezzoAggiudicatario()
    {
        return $this->prezzoAggiudicatario;
    }

    /**
     * Set nuovoPrezzobase
     *
     * @param string $nuovoPrezzobase
     * @return LottoVendite
     */
    public function setNuovoPrezzobase($nuovoPrezzobase)
    {
        $this->nuovoPrezzobase = $nuovoPrezzobase;

        return $this;
    }

    /**
     * Get nuovoPrezzobase
     *
     * @return string 
     */
    public function getNuovoPrezzobase()
    {
        return $this->nuovoPrezzobase;
    }

    /**
     * Set nuovaModalitavendita
     *
     * @param string $nuovaModalitavendita
     * @return LottoVendite
     */
    public function setNuovaModalitavendita($nuovaModalitavendita)
    {
        $this->nuovaModalitavendita = $nuovaModalitavendita;

        return $this;
    }

    /**
     * Get nuovaModalitavendita
     *
     * @return string 
     */
    public function getNuovaModalitavendita()
    {
        return $this->nuovaModalitavendita;
    }

    /**
     * Set oneriBolli
     *
     * @param string $oneriBolli
     * @return LottoVendite
     */
    public function setOneriBolli($oneriBolli)
    {
        $this->oneriBolli = $oneriBolli;

        return $this;
    }

    /**
     * Get oneriBolli
     *
     * @return string 
     */
    public function getOneriBolli()
    {
        return $this->oneriBolli;
    }

    /**
     * Set oneriTassaregistro
     *
     * @param string $oneriTassaregistro
     * @return LottoVendite
     */
    public function setOneriTassaregistro($oneriTassaregistro)
    {
        $this->oneriTassaregistro = $oneriTassaregistro;

        return $this;
    }

    /**
     * Get oneriTassaregistro
     *
     * @return string 
     */
    public function getOneriTassaregistro()
    {
        return $this->oneriTassaregistro;
    }

    /**
     * Set oneriIva
     *
     * @param string $oneriIva
     * @return LottoVendite
     */
    public function setOneriIva($oneriIva)
    {
        $this->oneriIva = $oneriIva;

        return $this;
    }

    /**
     * Get oneriIva
     *
     * @return string 
     */
    public function getOneriIva()
    {
        return $this->oneriIva;
    }

    /**
     * Set oneriSpeseaccessorie
     *
     * @param string $oneriSpeseaccessorie
     * @return LottoVendite
     */
    public function setOneriSpeseaccessorie($oneriSpeseaccessorie)
    {
        $this->oneriSpeseaccessorie = $oneriSpeseaccessorie;

        return $this;
    }

    /**
     * Get oneriSpeseaccessorie
     *
     * @return string 
     */
    public function getOneriSpeseaccessorie()
    {
        return $this->oneriSpeseaccessorie;
    }

    /**
     * Set oneriDirittiasta
     *
     * @param string $oneriDirittiasta
     * @return LottoVendite
     */
    public function setOneriDirittiasta($oneriDirittiasta)
    {
        $this->oneriDirittiasta = $oneriDirittiasta;

        return $this;
    }

    /**
     * Get oneriDirittiasta
     *
     * @return string 
     */
    public function getOneriDirittiasta()
    {
        return $this->oneriDirittiasta;
    }

    /**
     * Set oneriIvadirittiasta
     *
     * @param string $oneriIvadirittiasta
     * @return LottoVendite
     */
    public function setOneriIvadirittiasta($oneriIvadirittiasta)
    {
        $this->oneriIvadirittiasta = $oneriIvadirittiasta;

        return $this;
    }

    /**
     * Get oneriIvadirittiasta
     *
     * @return string 
     */
    public function getOneriIvadirittiasta()
    {
        return $this->oneriIvadirittiasta;
    }

    /**
     * Set rifIvg
     *
     * @param integer $rifIvg
     * @return LottoVendite
     */
    public function setRifIvg($rifIvg)
    {
        $this->rifIvg = $rifIvg;

        return $this;
    }

    /**
     * Get rifIvg
     *
     * @return integer 
     */
    public function getRifIvg()
    {
        return $this->rifIvg;
    }

    /**
     * Set rifTribunale
     *
     * @param integer $rifTribunale
     * @return LottoVendite
     */
    public function setRifTribunale($rifTribunale)
    {
        $this->rifTribunale = $rifTribunale;

        return $this;
    }

    /**
     * Get rifTribunale
     *
     * @return integer 
     */
    public function getRifTribunale()
    {
        return $this->rifTribunale;
    }

    /**
     * Set rifprocVendita
     *
     * @param integer $rifprocVendita
     * @return LottoVendite
     */
    public function setRifprocVendita($rifprocVendita)
    {
        $this->rifprocVendita = $rifprocVendita;

        return $this;
    }

    /**
     * Get rifprocVendita
     *
     * @return integer 
     */
    public function getRifprocVendita()
    {
        return $this->rifprocVendita;
    }

    /**
     * Set riflottoVendita
     *
     * @param integer $riflottoVendita
     * @return LottoVendite
     */
    public function setRiflottoVendita($riflottoVendita)
    {
        $this->riflottoVendita = $riflottoVendita;

        return $this;
    }

    /**
     * Get riflottoVendita
     *
     * @return integer 
     */
    public function getRiflottoVendita()
    {
        return $this->riflottoVendita;
    }
}
