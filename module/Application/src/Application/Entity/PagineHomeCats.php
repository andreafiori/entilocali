<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagineHomeCats
 *
 * @ORM\Table(name="pagine_home_cats")
 * @ORM\Entity
 */
class PagineHomeCats
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcathome", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcathome;

    /**
     * @var string
     *
     * @ORM\Column(name="nomemod", type="string", length=100, nullable=false)
     */
    private $nomemod;

    /**
     * @var string
     *
     * @ORM\Column(name="homelabel", type="string", length=100, nullable=false)
     */
    private $homelabel;

    /**
     * @var string
     *
     * @ORM\Column(name="cathome", type="string", length=100, nullable=false)
     */
    private $cathome;

    /**
     * @var string
     *
     * @ORM\Column(name="csshome", type="string", length=100, nullable=false)
     */
    private $csshome;

    /**
     * @var string
     *
     * @ORM\Column(name="attiva", type="string", nullable=false)
     */
    private $attiva = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="widthtable", type="string", length=50, nullable=false)
     */
    private $widthtable;

    /**
     * @var string
     *
     * @ORM\Column(name="newslinc", type="string", nullable=false)
     */
    private $newslinc = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="newsldef", type="string", length=80, nullable=false)
     */
    private $newsldef;

    /**
     * @var string
     *
     * @ORM\Column(name="evid", type="string", nullable=false)
     */
    private $evid = 'no';

    /**
     * @var integer
     *
     * @ORM\Column(name="posizhome", type="integer", nullable=false)
     */
    private $posizhome = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="classcsstd", type="string", length=80, nullable=false)
     */
    private $classcsstd;

    /**
     * @var string
     *
     * @ORM\Column(name="isnews", type="string", nullable=false)
     */
    private $isnews = 'no';

    /**
     * @var integer
     *
     * @ORM\Column(name="rif_idnews", type="integer", nullable=false)
     */
    private $rifIdnews = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifch", type="integer", nullable=false)
     */
    private $rifch = '1';



    /**
     * Get idcathome
     *
     * @return integer 
     */
    public function getIdcathome()
    {
        return $this->idcathome;
    }

    /**
     * Set nomemod
     *
     * @param string $nomemod
     * @return PagineHomeCats
     */
    public function setNomemod($nomemod)
    {
        $this->nomemod = $nomemod;

        return $this;
    }

    /**
     * Get nomemod
     *
     * @return string 
     */
    public function getNomemod()
    {
        return $this->nomemod;
    }

    /**
     * Set homelabel
     *
     * @param string $homelabel
     * @return PagineHomeCats
     */
    public function setHomelabel($homelabel)
    {
        $this->homelabel = $homelabel;

        return $this;
    }

    /**
     * Get homelabel
     *
     * @return string 
     */
    public function getHomelabel()
    {
        return $this->homelabel;
    }

    /**
     * Set cathome
     *
     * @param string $cathome
     * @return PagineHomeCats
     */
    public function setCathome($cathome)
    {
        $this->cathome = $cathome;

        return $this;
    }

    /**
     * Get cathome
     *
     * @return string 
     */
    public function getCathome()
    {
        return $this->cathome;
    }

    /**
     * Set csshome
     *
     * @param string $csshome
     * @return PagineHomeCats
     */
    public function setCsshome($csshome)
    {
        $this->csshome = $csshome;

        return $this;
    }

    /**
     * Get csshome
     *
     * @return string 
     */
    public function getCsshome()
    {
        return $this->csshome;
    }

    /**
     * Set attiva
     *
     * @param string $attiva
     * @return PagineHomeCats
     */
    public function setAttiva($attiva)
    {
        $this->attiva = $attiva;

        return $this;
    }

    /**
     * Get attiva
     *
     * @return string 
     */
    public function getAttiva()
    {
        return $this->attiva;
    }

    /**
     * Set widthtable
     *
     * @param string $widthtable
     * @return PagineHomeCats
     */
    public function setWidthtable($widthtable)
    {
        $this->widthtable = $widthtable;

        return $this;
    }

    /**
     * Get widthtable
     *
     * @return string 
     */
    public function getWidthtable()
    {
        return $this->widthtable;
    }

    /**
     * Set newslinc
     *
     * @param string $newslinc
     * @return PagineHomeCats
     */
    public function setNewslinc($newslinc)
    {
        $this->newslinc = $newslinc;

        return $this;
    }

    /**
     * Get newslinc
     *
     * @return string 
     */
    public function getNewslinc()
    {
        return $this->newslinc;
    }

    /**
     * Set newsldef
     *
     * @param string $newsldef
     * @return PagineHomeCats
     */
    public function setNewsldef($newsldef)
    {
        $this->newsldef = $newsldef;

        return $this;
    }

    /**
     * Get newsldef
     *
     * @return string 
     */
    public function getNewsldef()
    {
        return $this->newsldef;
    }

    /**
     * Set evid
     *
     * @param string $evid
     * @return PagineHomeCats
     */
    public function setEvid($evid)
    {
        $this->evid = $evid;

        return $this;
    }

    /**
     * Get evid
     *
     * @return string 
     */
    public function getEvid()
    {
        return $this->evid;
    }

    /**
     * Set posizhome
     *
     * @param integer $posizhome
     * @return PagineHomeCats
     */
    public function setPosizhome($posizhome)
    {
        $this->posizhome = $posizhome;

        return $this;
    }

    /**
     * Get posizhome
     *
     * @return integer 
     */
    public function getPosizhome()
    {
        return $this->posizhome;
    }

    /**
     * Set classcsstd
     *
     * @param string $classcsstd
     * @return PagineHomeCats
     */
    public function setClasscsstd($classcsstd)
    {
        $this->classcsstd = $classcsstd;

        return $this;
    }

    /**
     * Get classcsstd
     *
     * @return string 
     */
    public function getClasscsstd()
    {
        return $this->classcsstd;
    }

    /**
     * Set isnews
     *
     * @param string $isnews
     * @return PagineHomeCats
     */
    public function setIsnews($isnews)
    {
        $this->isnews = $isnews;

        return $this;
    }

    /**
     * Get isnews
     *
     * @return string 
     */
    public function getIsnews()
    {
        return $this->isnews;
    }

    /**
     * Set rifIdnews
     *
     * @param integer $rifIdnews
     * @return PagineHomeCats
     */
    public function setRifIdnews($rifIdnews)
    {
        $this->rifIdnews = $rifIdnews;

        return $this;
    }

    /**
     * Get rifIdnews
     *
     * @return integer 
     */
    public function getRifIdnews()
    {
        return $this->rifIdnews;
    }

    /**
     * Set rifch
     *
     * @param integer $rifch
     * @return PagineHomeCats
     */
    public function setRifch($rifch)
    {
        $this->rifch = $rifch;

        return $this;
    }

    /**
     * Get rifch
     *
     * @return integer 
     */
    public function getRifch()
    {
        return $this->rifch;
    }
}
