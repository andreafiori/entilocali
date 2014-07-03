<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContenuti
 *
 * @ORM\Table(name="zfcms_comuni_contenuti")
 * @ORM\Entity
 */
class ZfcmsComuniContenuti
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
     * @ORM\Column(name="id_sottosezione", type="integer", nullable=false)
     */
    private $idSottosezione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="anno", type="date", nullable=false)
     */
    private $anno = '0000';

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="text", length=65535, nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="sommario", type="text", length=65535, nullable=false)
     */
    private $sommario;

    /**
     * @var string
     *
     * @ORM\Column(name="testo", type="text", nullable=false)
     */
    private $testo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inserimento", type="date", nullable=false)
     */
    private $dataInserimento = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_scadenza", type="date", nullable=false)
     */
    private $dataScadenza = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_invio_regione", type="date", nullable=false)
     */
    private $dataInvioRegione = '0000-00-00';

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="home", type="integer", nullable=false)
     */
    private $home;

    /**
     * @var integer
     *
     * @ORM\Column(name="evidenza", type="integer", nullable=false)
     */
    private $evidenza;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_utente", type="integer", nullable=false)
     */
    private $idUtente;

    /**
     * @var integer
     *
     * @ORM\Column(name="rss", type="integer", nullable=false)
     */
    private $rss;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pub_albo_comune", type="date", nullable=false)
     */
    private $pubAlboComune = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_rettifica", type="date", nullable=false)
     */
    private $dataRettifica = '0000-00-00';



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
     * Set idSottosezione
     *
     * @param integer $idSottosezione
     *
     * @return ZfcmsComuniContenuti
     */
    public function setIdSottosezione($idSottosezione)
    {
        $this->idSottosezione = $idSottosezione;
    
        return $this;
    }

    /**
     * Get idSottosezione
     *
     * @return integer
     */
    public function getIdSottosezione()
    {
        return $this->idSottosezione;
    }

    /**
     * Set anno
     *
     * @param \DateTime $anno
     *
     * @return ZfcmsComuniContenuti
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;
    
        return $this;
    }

    /**
     * Get anno
     *
     * @return \DateTime
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return ZfcmsComuniContenuti
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
     * Set titolo
     *
     * @param string $titolo
     *
     * @return ZfcmsComuniContenuti
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
     * Set sommario
     *
     * @param string $sommario
     *
     * @return ZfcmsComuniContenuti
     */
    public function setSommario($sommario)
    {
        $this->sommario = $sommario;
    
        return $this;
    }

    /**
     * Get sommario
     *
     * @return string
     */
    public function getSommario()
    {
        return $this->sommario;
    }

    /**
     * Set testo
     *
     * @param string $testo
     *
     * @return ZfcmsComuniContenuti
     */
    public function setTesto($testo)
    {
        $this->testo = $testo;
    
        return $this;
    }

    /**
     * Get testo
     *
     * @return string
     */
    public function getTesto()
    {
        return $this->testo;
    }

    /**
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     *
     * @return ZfcmsComuniContenuti
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
     * Set dataScadenza
     *
     * @param \DateTime $dataScadenza
     *
     * @return ZfcmsComuniContenuti
     */
    public function setDataScadenza($dataScadenza)
    {
        $this->dataScadenza = $dataScadenza;
    
        return $this;
    }

    /**
     * Get dataScadenza
     *
     * @return \DateTime
     */
    public function getDataScadenza()
    {
        return $this->dataScadenza;
    }

    /**
     * Set dataInvioRegione
     *
     * @param \DateTime $dataInvioRegione
     *
     * @return ZfcmsComuniContenuti
     */
    public function setDataInvioRegione($dataInvioRegione)
    {
        $this->dataInvioRegione = $dataInvioRegione;
    
        return $this;
    }

    /**
     * Get dataInvioRegione
     *
     * @return \DateTime
     */
    public function getDataInvioRegione()
    {
        return $this->dataInvioRegione;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     *
     * @return ZfcmsComuniContenuti
     */
    public function setAttivo($attivo)
    {
        $this->attivo = $attivo;
    
        return $this;
    }

    /**
     * Get attivo
     *
     * @return integer
     */
    public function getAttivo()
    {
        return $this->attivo;
    }

    /**
     * Set home
     *
     * @param integer $home
     *
     * @return ZfcmsComuniContenuti
     */
    public function setHome($home)
    {
        $this->home = $home;
    
        return $this;
    }

    /**
     * Get home
     *
     * @return integer
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set evidenza
     *
     * @param integer $evidenza
     *
     * @return ZfcmsComuniContenuti
     */
    public function setEvidenza($evidenza)
    {
        $this->evidenza = $evidenza;
    
        return $this;
    }

    /**
     * Get evidenza
     *
     * @return integer
     */
    public function getEvidenza()
    {
        return $this->evidenza;
    }

    /**
     * Set idUtente
     *
     * @param integer $idUtente
     *
     * @return ZfcmsComuniContenuti
     */
    public function setIdUtente($idUtente)
    {
        $this->idUtente = $idUtente;
    
        return $this;
    }

    /**
     * Get idUtente
     *
     * @return integer
     */
    public function getIdUtente()
    {
        return $this->idUtente;
    }

    /**
     * Set rss
     *
     * @param integer $rss
     *
     * @return ZfcmsComuniContenuti
     */
    public function setRss($rss)
    {
        $this->rss = $rss;
    
        return $this;
    }

    /**
     * Get rss
     *
     * @return integer
     */
    public function getRss()
    {
        return $this->rss;
    }

    /**
     * Set pubAlboComune
     *
     * @param \DateTime $pubAlboComune
     *
     * @return ZfcmsComuniContenuti
     */
    public function setPubAlboComune($pubAlboComune)
    {
        $this->pubAlboComune = $pubAlboComune;
    
        return $this;
    }

    /**
     * Get pubAlboComune
     *
     * @return \DateTime
     */
    public function getPubAlboComune()
    {
        return $this->pubAlboComune;
    }

    /**
     * Set dataRettifica
     *
     * @param \DateTime $dataRettifica
     *
     * @return ZfcmsComuniContenuti
     */
    public function setDataRettifica($dataRettifica)
    {
        $this->dataRettifica = $dataRettifica;
    
        return $this;
    }

    /**
     * Get dataRettifica
     *
     * @return \DateTime
     */
    public function getDataRettifica()
    {
        return $this->dataRettifica;
    }
}
