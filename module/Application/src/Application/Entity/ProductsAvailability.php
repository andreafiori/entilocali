<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsAvailability
 *
 * @ORM\Table(name="products_availability")
 * @ORM\Entity
 */
class ProductsAvailability
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
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'si';

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=false)
     */
    private $position = '0';



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
     * @return ProductsAvailability
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
     * @return ProductsAvailability
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
     * @return ProductsAvailability
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
     * @return ProductsAvailability
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
     * @return ProductsAvailability
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
     * Set status
     *
     * @param string $status
     * @return ProductsAvailability
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
     * Set position
     *
     * @param integer $position
     * @return ProductsAvailability
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
