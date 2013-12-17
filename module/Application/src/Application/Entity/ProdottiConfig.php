<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiConfig
 *
 * @ORM\Table(name="prodotti_config")
 * @ORM\Entity
 */
class ProdottiConfig
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
     * @ORM\Column(name="thumb_width", type="integer", nullable=false)
     */
    private $thumbWidth = '70';

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_height", type="integer", nullable=false)
     */
    private $thumbHeight = '40';

    /**
     * @var integer
     *
     * @ORM\Column(name="kb_img", type="integer", nullable=false)
     */
    private $kbImg = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="img_big_max_width", type="integer", nullable=false)
     */
    private $imgBigMaxWidth = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="img_big_max_height", type="integer", nullable=false)
     */
    private $imgBigMaxHeight = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="kb_imgbig", type="integer", nullable=false)
     */
    private $kbImgbig = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dirprodtb", type="string", length=100, nullable=false)
     */
    private $dirprodtb;

    /**
     * @var string
     *
     * @ORM\Column(name="dirprodbig", type="string", length=100, nullable=false)
     */
    private $dirprodbig;

    /**
     * @var string
     *
     * @ORM\Column(name="dirmarchetb", type="string", length=100, nullable=false)
     */
    private $dirmarchetb;

    /**
     * @var string
     *
     * @ORM\Column(name="dirmarchebig", type="string", length=100, nullable=false)
     */
    private $dirmarchebig;

    /**
     * @var string
     *
     * @ORM\Column(name="ordinemin", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $ordinemin = '1.00';

    /**
     * @var string
     *
     * @ORM\Column(name="calc_iva", type="string", nullable=false)
     */
    private $calcIva = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="calc_spediz", type="string", nullable=false)
     */
    private $calcSpediz = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="calc_sconto", type="string", nullable=false)
     */
    private $calcSconto = 'no';



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
     * Set thumbWidth
     *
     * @param integer $thumbWidth
     * @return ProdottiConfig
     */
    public function setThumbWidth($thumbWidth)
    {
        $this->thumbWidth = $thumbWidth;

        return $this;
    }

    /**
     * Get thumbWidth
     *
     * @return integer 
     */
    public function getThumbWidth()
    {
        return $this->thumbWidth;
    }

    /**
     * Set thumbHeight
     *
     * @param integer $thumbHeight
     * @return ProdottiConfig
     */
    public function setThumbHeight($thumbHeight)
    {
        $this->thumbHeight = $thumbHeight;

        return $this;
    }

    /**
     * Get thumbHeight
     *
     * @return integer 
     */
    public function getThumbHeight()
    {
        return $this->thumbHeight;
    }

    /**
     * Set kbImg
     *
     * @param integer $kbImg
     * @return ProdottiConfig
     */
    public function setKbImg($kbImg)
    {
        $this->kbImg = $kbImg;

        return $this;
    }

    /**
     * Get kbImg
     *
     * @return integer 
     */
    public function getKbImg()
    {
        return $this->kbImg;
    }

    /**
     * Set imgBigMaxWidth
     *
     * @param integer $imgBigMaxWidth
     * @return ProdottiConfig
     */
    public function setImgBigMaxWidth($imgBigMaxWidth)
    {
        $this->imgBigMaxWidth = $imgBigMaxWidth;

        return $this;
    }

    /**
     * Get imgBigMaxWidth
     *
     * @return integer 
     */
    public function getImgBigMaxWidth()
    {
        return $this->imgBigMaxWidth;
    }

    /**
     * Set imgBigMaxHeight
     *
     * @param integer $imgBigMaxHeight
     * @return ProdottiConfig
     */
    public function setImgBigMaxHeight($imgBigMaxHeight)
    {
        $this->imgBigMaxHeight = $imgBigMaxHeight;

        return $this;
    }

    /**
     * Get imgBigMaxHeight
     *
     * @return integer 
     */
    public function getImgBigMaxHeight()
    {
        return $this->imgBigMaxHeight;
    }

    /**
     * Set kbImgbig
     *
     * @param integer $kbImgbig
     * @return ProdottiConfig
     */
    public function setKbImgbig($kbImgbig)
    {
        $this->kbImgbig = $kbImgbig;

        return $this;
    }

    /**
     * Get kbImgbig
     *
     * @return integer 
     */
    public function getKbImgbig()
    {
        return $this->kbImgbig;
    }

    /**
     * Set dirprodtb
     *
     * @param string $dirprodtb
     * @return ProdottiConfig
     */
    public function setDirprodtb($dirprodtb)
    {
        $this->dirprodtb = $dirprodtb;

        return $this;
    }

    /**
     * Get dirprodtb
     *
     * @return string 
     */
    public function getDirprodtb()
    {
        return $this->dirprodtb;
    }

    /**
     * Set dirprodbig
     *
     * @param string $dirprodbig
     * @return ProdottiConfig
     */
    public function setDirprodbig($dirprodbig)
    {
        $this->dirprodbig = $dirprodbig;

        return $this;
    }

    /**
     * Get dirprodbig
     *
     * @return string 
     */
    public function getDirprodbig()
    {
        return $this->dirprodbig;
    }

    /**
     * Set dirmarchetb
     *
     * @param string $dirmarchetb
     * @return ProdottiConfig
     */
    public function setDirmarchetb($dirmarchetb)
    {
        $this->dirmarchetb = $dirmarchetb;

        return $this;
    }

    /**
     * Get dirmarchetb
     *
     * @return string 
     */
    public function getDirmarchetb()
    {
        return $this->dirmarchetb;
    }

    /**
     * Set dirmarchebig
     *
     * @param string $dirmarchebig
     * @return ProdottiConfig
     */
    public function setDirmarchebig($dirmarchebig)
    {
        $this->dirmarchebig = $dirmarchebig;

        return $this;
    }

    /**
     * Get dirmarchebig
     *
     * @return string 
     */
    public function getDirmarchebig()
    {
        return $this->dirmarchebig;
    }

    /**
     * Set ordinemin
     *
     * @param string $ordinemin
     * @return ProdottiConfig
     */
    public function setOrdinemin($ordinemin)
    {
        $this->ordinemin = $ordinemin;

        return $this;
    }

    /**
     * Get ordinemin
     *
     * @return string 
     */
    public function getOrdinemin()
    {
        return $this->ordinemin;
    }

    /**
     * Set calcIva
     *
     * @param string $calcIva
     * @return ProdottiConfig
     */
    public function setCalcIva($calcIva)
    {
        $this->calcIva = $calcIva;

        return $this;
    }

    /**
     * Get calcIva
     *
     * @return string 
     */
    public function getCalcIva()
    {
        return $this->calcIva;
    }

    /**
     * Set calcSpediz
     *
     * @param string $calcSpediz
     * @return ProdottiConfig
     */
    public function setCalcSpediz($calcSpediz)
    {
        $this->calcSpediz = $calcSpediz;

        return $this;
    }

    /**
     * Get calcSpediz
     *
     * @return string 
     */
    public function getCalcSpediz()
    {
        return $this->calcSpediz;
    }

    /**
     * Set calcSconto
     *
     * @param string $calcSconto
     * @return ProdottiConfig
     */
    public function setCalcSconto($calcSconto)
    {
        $this->calcSconto = $calcSconto;

        return $this;
    }

    /**
     * Get calcSconto
     *
     * @return string 
     */
    public function getCalcSconto()
    {
        return $this->calcSconto;
    }
}
