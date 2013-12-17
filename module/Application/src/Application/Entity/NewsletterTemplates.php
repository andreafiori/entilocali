<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterTemplates
 *
 * @ORM\Table(name="newsletter_templates")
 * @ORM\Entity
 */
class NewsletterTemplates
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtmp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtmp;

    /**
     * @var string
     *
     * @ORM\Column(name="nometemp", type="string", length=80, nullable=false)
     */
    private $nometemp;

    /**
     * @var string
     *
     * @ORM\Column(name="nomefile", type="string", length=100, nullable=false)
     */
    private $nomefile;

    /**
     * @var string
     *
     * @ORM\Column(name="cssfile", type="string", length=100, nullable=false)
     */
    private $cssfile;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=150, nullable=false)
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", nullable=false)
     */
    private $format = 'html';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datacreaz", type="datetime", nullable=false)
     */
    private $datacreaz = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="posizion", type="integer", nullable=false)
     */
    private $posizion = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="visibile", type="string", nullable=false)
     */
    private $visibile = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="predef", type="string", nullable=false)
     */
    private $predef = 'no';

    /**
     * @var integer
     *
     * @ORM\Column(name="riflang", type="integer", nullable=false)
     */
    private $riflang = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifchannel", type="integer", nullable=false)
     */
    private $rifchannel = '1';



    /**
     * Get idtmp
     *
     * @return integer 
     */
    public function getIdtmp()
    {
        return $this->idtmp;
    }

    /**
     * Set nometemp
     *
     * @param string $nometemp
     * @return NewsletterTemplates
     */
    public function setNometemp($nometemp)
    {
        $this->nometemp = $nometemp;

        return $this;
    }

    /**
     * Get nometemp
     *
     * @return string 
     */
    public function getNometemp()
    {
        return $this->nometemp;
    }

    /**
     * Set nomefile
     *
     * @param string $nomefile
     * @return NewsletterTemplates
     */
    public function setNomefile($nomefile)
    {
        $this->nomefile = $nomefile;

        return $this;
    }

    /**
     * Get nomefile
     *
     * @return string 
     */
    public function getNomefile()
    {
        return $this->nomefile;
    }

    /**
     * Set cssfile
     *
     * @param string $cssfile
     * @return NewsletterTemplates
     */
    public function setCssfile($cssfile)
    {
        $this->cssfile = $cssfile;

        return $this;
    }

    /**
     * Get cssfile
     *
     * @return string 
     */
    public function getCssfile()
    {
        return $this->cssfile;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     * @return NewsletterTemplates
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string 
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return NewsletterTemplates
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set datacreaz
     *
     * @param \DateTime $datacreaz
     * @return NewsletterTemplates
     */
    public function setDatacreaz($datacreaz)
    {
        $this->datacreaz = $datacreaz;

        return $this;
    }

    /**
     * Get datacreaz
     *
     * @return \DateTime 
     */
    public function getDatacreaz()
    {
        return $this->datacreaz;
    }

    /**
     * Set posizion
     *
     * @param integer $posizion
     * @return NewsletterTemplates
     */
    public function setPosizion($posizion)
    {
        $this->posizion = $posizion;

        return $this;
    }

    /**
     * Get posizion
     *
     * @return integer 
     */
    public function getPosizion()
    {
        return $this->posizion;
    }

    /**
     * Set visibile
     *
     * @param string $visibile
     * @return NewsletterTemplates
     */
    public function setVisibile($visibile)
    {
        $this->visibile = $visibile;

        return $this;
    }

    /**
     * Get visibile
     *
     * @return string 
     */
    public function getVisibile()
    {
        return $this->visibile;
    }

    /**
     * Set predef
     *
     * @param string $predef
     * @return NewsletterTemplates
     */
    public function setPredef($predef)
    {
        $this->predef = $predef;

        return $this;
    }

    /**
     * Get predef
     *
     * @return string 
     */
    public function getPredef()
    {
        return $this->predef;
    }

    /**
     * Set riflang
     *
     * @param integer $riflang
     * @return NewsletterTemplates
     */
    public function setRiflang($riflang)
    {
        $this->riflang = $riflang;

        return $this;
    }

    /**
     * Get riflang
     *
     * @return integer 
     */
    public function getRiflang()
    {
        return $this->riflang;
    }

    /**
     * Set rifchannel
     *
     * @param integer $rifchannel
     * @return NewsletterTemplates
     */
    public function setRifchannel($rifchannel)
    {
        $this->rifchannel = $rifchannel;

        return $this;
    }

    /**
     * Get rifchannel
     *
     * @return integer 
     */
    public function getRifchannel()
    {
        return $this->rifchannel;
    }
}
