<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlboAtti
 *
 * @ORM\Table(name="albo_atti", indexes={@ORM\Index(name="srchfields", columns={"sezione_id", "settore_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class AlboAtti
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
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer", nullable=false)
     */
    private $anno;

    /**
     * @var string
     *
     * @ORM\Column(name="oggetto", type="text", nullable=false)
     */
    private $oggetto;

    /**
     * @var string
     *
     * @ORM\Column(name="maintext", type="text", nullable=false)
     */
    private $maintext;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datarichiesta", type="datetime", nullable=false)
     */
    private $datarichiesta = '2012-01-01 01:01:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datapubblicazione", type="datetime", nullable=false)
     */
    private $datapubblicazione = '2012-01-01 01:01:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datascadenza", type="datetime", nullable=false)
     */
    private $datascadenza = '2012-01-01 01:01:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="numgiorniscadenza", type="integer", nullable=false)
     */
    private $numgiorniscadenza = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="annullato", type="string", nullable=false)
     */
    private $annullato = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datannullamento", type="datetime", nullable=false)
     */
    private $datannullamento = '2012-01-01 01:01:00';

    /**
     * @var string
     *
     * @ORM\Column(name="noteannullamento", type="text", nullable=false)
     */
    private $noteannullamento;

    /**
     * @var string
     *
     * @ORM\Column(name="rettificato", type="string", nullable=false)
     */
    private $rettificato = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datarettifica", type="datetime", nullable=false)
     */
    private $datarettifica = '2012-01-01 01:01:00';

    /**
     * @var string
     *
     * @ORM\Column(name="noterettifica", type="text", nullable=false)
     */
    private $noterettifica;

    /**
     * @var string
     *
     * @ORM\Column(name="visibility", type="string", nullable=false)
     */
    private $visibility = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="inviatoregione", type="string", nullable=false)
     */
    private $inviatoregione = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="enteterzo", type="string", length=80, nullable=false)
     */
    private $enteterzo;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keys", type="string", length=80, nullable=false)
     */
    private $seoKeys;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=150, nullable=false)
     */
    private $seoDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="settore_id", type="integer", nullable=false)
     */
    private $settoreId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sezione_id", type="integer", nullable=false)
     */
    private $sezioneId = '0';



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
     * Set numero
     *
     * @param integer $numero
     * @return AlboAtti
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set anno
     *
     * @param integer $anno
     * @return AlboAtti
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return integer 
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set oggetto
     *
     * @param string $oggetto
     * @return AlboAtti
     */
    public function setOggetto($oggetto)
    {
        $this->oggetto = $oggetto;

        return $this;
    }

    /**
     * Get oggetto
     *
     * @return string 
     */
    public function getOggetto()
    {
        return $this->oggetto;
    }

    /**
     * Set maintext
     *
     * @param string $maintext
     * @return AlboAtti
     */
    public function setMaintext($maintext)
    {
        $this->maintext = $maintext;

        return $this;
    }

    /**
     * Get maintext
     *
     * @return string 
     */
    public function getMaintext()
    {
        return $this->maintext;
    }

    /**
     * Set datarichiesta
     *
     * @param \DateTime $datarichiesta
     * @return AlboAtti
     */
    public function setDatarichiesta($datarichiesta)
    {
        $this->datarichiesta = $datarichiesta;

        return $this;
    }

    /**
     * Get datarichiesta
     *
     * @return \DateTime 
     */
    public function getDatarichiesta()
    {
        return $this->datarichiesta;
    }

    /**
     * Set datapubblicazione
     *
     * @param \DateTime $datapubblicazione
     * @return AlboAtti
     */
    public function setDatapubblicazione($datapubblicazione)
    {
        $this->datapubblicazione = $datapubblicazione;

        return $this;
    }

    /**
     * Get datapubblicazione
     *
     * @return \DateTime 
     */
    public function getDatapubblicazione()
    {
        return $this->datapubblicazione;
    }

    /**
     * Set datascadenza
     *
     * @param \DateTime $datascadenza
     * @return AlboAtti
     */
    public function setDatascadenza($datascadenza)
    {
        $this->datascadenza = $datascadenza;

        return $this;
    }

    /**
     * Get datascadenza
     *
     * @return \DateTime 
     */
    public function getDatascadenza()
    {
        return $this->datascadenza;
    }

    /**
     * Set numgiorniscadenza
     *
     * @param integer $numgiorniscadenza
     * @return AlboAtti
     */
    public function setNumgiorniscadenza($numgiorniscadenza)
    {
        $this->numgiorniscadenza = $numgiorniscadenza;

        return $this;
    }

    /**
     * Get numgiorniscadenza
     *
     * @return integer 
     */
    public function getNumgiorniscadenza()
    {
        return $this->numgiorniscadenza;
    }

    /**
     * Set annullato
     *
     * @param string $annullato
     * @return AlboAtti
     */
    public function setAnnullato($annullato)
    {
        $this->annullato = $annullato;

        return $this;
    }

    /**
     * Get annullato
     *
     * @return string 
     */
    public function getAnnullato()
    {
        return $this->annullato;
    }

    /**
     * Set datannullamento
     *
     * @param \DateTime $datannullamento
     * @return AlboAtti
     */
    public function setDatannullamento($datannullamento)
    {
        $this->datannullamento = $datannullamento;

        return $this;
    }

    /**
     * Get datannullamento
     *
     * @return \DateTime 
     */
    public function getDatannullamento()
    {
        return $this->datannullamento;
    }

    /**
     * Set noteannullamento
     *
     * @param string $noteannullamento
     * @return AlboAtti
     */
    public function setNoteannullamento($noteannullamento)
    {
        $this->noteannullamento = $noteannullamento;

        return $this;
    }

    /**
     * Get noteannullamento
     *
     * @return string 
     */
    public function getNoteannullamento()
    {
        return $this->noteannullamento;
    }

    /**
     * Set rettificato
     *
     * @param string $rettificato
     * @return AlboAtti
     */
    public function setRettificato($rettificato)
    {
        $this->rettificato = $rettificato;

        return $this;
    }

    /**
     * Get rettificato
     *
     * @return string 
     */
    public function getRettificato()
    {
        return $this->rettificato;
    }

    /**
     * Set datarettifica
     *
     * @param \DateTime $datarettifica
     * @return AlboAtti
     */
    public function setDatarettifica($datarettifica)
    {
        $this->datarettifica = $datarettifica;

        return $this;
    }

    /**
     * Get datarettifica
     *
     * @return \DateTime 
     */
    public function getDatarettifica()
    {
        return $this->datarettifica;
    }

    /**
     * Set noterettifica
     *
     * @param string $noterettifica
     * @return AlboAtti
     */
    public function setNoterettifica($noterettifica)
    {
        $this->noterettifica = $noterettifica;

        return $this;
    }

    /**
     * Get noterettifica
     *
     * @return string 
     */
    public function getNoterettifica()
    {
        return $this->noterettifica;
    }

    /**
     * Set visibility
     *
     * @param string $visibility
     * @return AlboAtti
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return string 
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set inviatoregione
     *
     * @param string $inviatoregione
     * @return AlboAtti
     */
    public function setInviatoregione($inviatoregione)
    {
        $this->inviatoregione = $inviatoregione;

        return $this;
    }

    /**
     * Get inviatoregione
     *
     * @return string 
     */
    public function getInviatoregione()
    {
        return $this->inviatoregione;
    }

    /**
     * Set enteterzo
     *
     * @param string $enteterzo
     * @return AlboAtti
     */
    public function setEnteterzo($enteterzo)
    {
        $this->enteterzo = $enteterzo;

        return $this;
    }

    /**
     * Get enteterzo
     *
     * @return string 
     */
    public function getEnteterzo()
    {
        return $this->enteterzo;
    }

    /**
     * Set seoKeys
     *
     * @param string $seoKeys
     * @return AlboAtti
     */
    public function setSeoKeys($seoKeys)
    {
        $this->seoKeys = $seoKeys;

        return $this;
    }

    /**
     * Get seoKeys
     *
     * @return string 
     */
    public function getSeoKeys()
    {
        return $this->seoKeys;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return AlboAtti
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string 
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set settoreId
     *
     * @param integer $settoreId
     * @return AlboAtti
     */
    public function setSettoreId($settoreId)
    {
        $this->settoreId = $settoreId;

        return $this;
    }

    /**
     * Get settoreId
     *
     * @return integer 
     */
    public function getSettoreId()
    {
        return $this->settoreId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return AlboAtti
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
     * Set sezioneId
     *
     * @param integer $sezioneId
     * @return AlboAtti
     */
    public function setSezioneId($sezioneId)
    {
        $this->sezioneId = $sezioneId;

        return $this;
    }

    /**
     * Get sezioneId
     *
     * @return integer 
     */
    public function getSezioneId()
    {
        return $this->sezioneId;
    }
}
