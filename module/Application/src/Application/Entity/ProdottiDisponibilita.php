<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiDisponibilita
 *
 * @ORM\Table(name="prodotti_disponibilita")
 * @ORM\Entity
 */
class ProdottiDisponibilita
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
     * @ORM\Column(name="imgdisp", type="string", length=60, nullable=false)
     */
    private $imgdisp;

    /**
     * @var string
     *
     * @ORM\Column(name="nomedisp_lang1", type="string", length=100, nullable=false)
     */
    private $nomedispLang1;

    /**
     * @var string
     *
     * @ORM\Column(name="nomedisp_lang2", type="string", length=100, nullable=false)
     */
    private $nomedispLang2;

    /**
     * @var string
     *
     * @ORM\Column(name="nomedisp_lang3", type="string", length=100, nullable=false)
     */
    private $nomedispLang3;

    /**
     * @var string
     *
     * @ORM\Column(name="nomedisp_lang4", type="string", length=100, nullable=false)
     */
    private $nomedispLang4;

    /**
     * @var string
     *
     * @ORM\Column(name="visib", type="string", nullable=false)
     */
    private $visib = 'si';

    /**
     * @var integer
     *
     * @ORM\Column(name="posiz", type="integer", nullable=false)
     */
    private $posiz = '0';



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
     * Set imgdisp
     *
     * @param string $imgdisp
     * @return ProdottiDisponibilita
     */
    public function setImgdisp($imgdisp)
    {
        $this->imgdisp = $imgdisp;

        return $this;
    }

    /**
     * Get imgdisp
     *
     * @return string 
     */
    public function getImgdisp()
    {
        return $this->imgdisp;
    }

    /**
     * Set nomedispLang1
     *
     * @param string $nomedispLang1
     * @return ProdottiDisponibilita
     */
    public function setNomedispLang1($nomedispLang1)
    {
        $this->nomedispLang1 = $nomedispLang1;

        return $this;
    }

    /**
     * Get nomedispLang1
     *
     * @return string 
     */
    public function getNomedispLang1()
    {
        return $this->nomedispLang1;
    }

    /**
     * Set nomedispLang2
     *
     * @param string $nomedispLang2
     * @return ProdottiDisponibilita
     */
    public function setNomedispLang2($nomedispLang2)
    {
        $this->nomedispLang2 = $nomedispLang2;

        return $this;
    }

    /**
     * Get nomedispLang2
     *
     * @return string 
     */
    public function getNomedispLang2()
    {
        return $this->nomedispLang2;
    }

    /**
     * Set nomedispLang3
     *
     * @param string $nomedispLang3
     * @return ProdottiDisponibilita
     */
    public function setNomedispLang3($nomedispLang3)
    {
        $this->nomedispLang3 = $nomedispLang3;

        return $this;
    }

    /**
     * Get nomedispLang3
     *
     * @return string 
     */
    public function getNomedispLang3()
    {
        return $this->nomedispLang3;
    }

    /**
     * Set nomedispLang4
     *
     * @param string $nomedispLang4
     * @return ProdottiDisponibilita
     */
    public function setNomedispLang4($nomedispLang4)
    {
        $this->nomedispLang4 = $nomedispLang4;

        return $this;
    }

    /**
     * Get nomedispLang4
     *
     * @return string 
     */
    public function getNomedispLang4()
    {
        return $this->nomedispLang4;
    }

    /**
     * Set visib
     *
     * @param string $visib
     * @return ProdottiDisponibilita
     */
    public function setVisib($visib)
    {
        $this->visib = $visib;

        return $this;
    }

    /**
     * Get visib
     *
     * @return string 
     */
    public function getVisib()
    {
        return $this->visib;
    }

    /**
     * Set posiz
     *
     * @param integer $posiz
     * @return ProdottiDisponibilita
     */
    public function setPosiz($posiz)
    {
        $this->posiz = $posiz;

        return $this;
    }

    /**
     * Get posiz
     *
     * @return integer 
     */
    public function getPosiz()
    {
        return $this->posiz;
    }
}
