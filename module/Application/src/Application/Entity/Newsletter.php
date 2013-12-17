<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter", uniqueConstraints={@ORM\UniqueConstraint(name="titlo", columns={"titolo"})})
 * @ORM\Entity
 */
class Newsletter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idnews", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnews;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="string", length=100, nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo_lang2", type="string", length=100, nullable=false)
     */
    private $titoloLang2;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo_lang3", type="string", length=100, nullable=false)
     */
    private $titoloLang3;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo_lang4", type="string", length=100, nullable=false)
     */
    private $titoloLang4;

    /**
     * @var string
     *
     * @ORM\Column(name="msgnewsl", type="text", nullable=false)
     */
    private $msgnewsl;

    /**
     * @var string
     *
     * @ORM\Column(name="msgnewsl_lang2", type="text", nullable=false)
     */
    private $msgnewslLang2;

    /**
     * @var string
     *
     * @ORM\Column(name="msgnewsl_lang3", type="text", nullable=false)
     */
    private $msgnewslLang3;

    /**
     * @var string
     *
     * @ORM\Column(name="msgnewsl_lang4", type="text", nullable=false)
     */
    private $msgnewslLang4;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datacreaz", type="datetime", nullable=false)
     */
    private $datacreaz = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datainvio", type="datetime", nullable=false)
     */
    private $datainvio = '2010-01-01 01:01:00';

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="string", length=40, nullable=false)
     */
    private $formato;

    /**
     * @var string
     *
     * @ORM\Column(name="inviata", type="string", nullable=false)
     */
    private $inviata = 'no';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifcat", type="integer", nullable=false)
     */
    private $rifcat = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifchannel", type="integer", nullable=false)
     */
    private $rifchannel = '1';



    /**
     * Get idnews
     *
     * @return integer 
     */
    public function getIdnews()
    {
        return $this->idnews;
    }

    /**
     * Set titolo
     *
     * @param string $titolo
     * @return Newsletter
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
     * Set titoloLang2
     *
     * @param string $titoloLang2
     * @return Newsletter
     */
    public function setTitoloLang2($titoloLang2)
    {
        $this->titoloLang2 = $titoloLang2;

        return $this;
    }

    /**
     * Get titoloLang2
     *
     * @return string 
     */
    public function getTitoloLang2()
    {
        return $this->titoloLang2;
    }

    /**
     * Set titoloLang3
     *
     * @param string $titoloLang3
     * @return Newsletter
     */
    public function setTitoloLang3($titoloLang3)
    {
        $this->titoloLang3 = $titoloLang3;

        return $this;
    }

    /**
     * Get titoloLang3
     *
     * @return string 
     */
    public function getTitoloLang3()
    {
        return $this->titoloLang3;
    }

    /**
     * Set titoloLang4
     *
     * @param string $titoloLang4
     * @return Newsletter
     */
    public function setTitoloLang4($titoloLang4)
    {
        $this->titoloLang4 = $titoloLang4;

        return $this;
    }

    /**
     * Get titoloLang4
     *
     * @return string 
     */
    public function getTitoloLang4()
    {
        return $this->titoloLang4;
    }

    /**
     * Set msgnewsl
     *
     * @param string $msgnewsl
     * @return Newsletter
     */
    public function setMsgnewsl($msgnewsl)
    {
        $this->msgnewsl = $msgnewsl;

        return $this;
    }

    /**
     * Get msgnewsl
     *
     * @return string 
     */
    public function getMsgnewsl()
    {
        return $this->msgnewsl;
    }

    /**
     * Set msgnewslLang2
     *
     * @param string $msgnewslLang2
     * @return Newsletter
     */
    public function setMsgnewslLang2($msgnewslLang2)
    {
        $this->msgnewslLang2 = $msgnewslLang2;

        return $this;
    }

    /**
     * Get msgnewslLang2
     *
     * @return string 
     */
    public function getMsgnewslLang2()
    {
        return $this->msgnewslLang2;
    }

    /**
     * Set msgnewslLang3
     *
     * @param string $msgnewslLang3
     * @return Newsletter
     */
    public function setMsgnewslLang3($msgnewslLang3)
    {
        $this->msgnewslLang3 = $msgnewslLang3;

        return $this;
    }

    /**
     * Get msgnewslLang3
     *
     * @return string 
     */
    public function getMsgnewslLang3()
    {
        return $this->msgnewslLang3;
    }

    /**
     * Set msgnewslLang4
     *
     * @param string $msgnewslLang4
     * @return Newsletter
     */
    public function setMsgnewslLang4($msgnewslLang4)
    {
        $this->msgnewslLang4 = $msgnewslLang4;

        return $this;
    }

    /**
     * Get msgnewslLang4
     *
     * @return string 
     */
    public function getMsgnewslLang4()
    {
        return $this->msgnewslLang4;
    }

    /**
     * Set datacreaz
     *
     * @param \DateTime $datacreaz
     * @return Newsletter
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
     * Set datainvio
     *
     * @param \DateTime $datainvio
     * @return Newsletter
     */
    public function setDatainvio($datainvio)
    {
        $this->datainvio = $datainvio;

        return $this;
    }

    /**
     * Get datainvio
     *
     * @return \DateTime 
     */
    public function getDatainvio()
    {
        return $this->datainvio;
    }

    /**
     * Set formato
     *
     * @param string $formato
     * @return Newsletter
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
     * Set inviata
     *
     * @param string $inviata
     * @return Newsletter
     */
    public function setInviata($inviata)
    {
        $this->inviata = $inviata;

        return $this;
    }

    /**
     * Get inviata
     *
     * @return string 
     */
    public function getInviata()
    {
        return $this->inviata;
    }

    /**
     * Set rifcat
     *
     * @param integer $rifcat
     * @return Newsletter
     */
    public function setRifcat($rifcat)
    {
        $this->rifcat = $rifcat;

        return $this;
    }

    /**
     * Get rifcat
     *
     * @return integer 
     */
    public function getRifcat()
    {
        return $this->rifcat;
    }

    /**
     * Set rifchannel
     *
     * @param integer $rifchannel
     * @return Newsletter
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
