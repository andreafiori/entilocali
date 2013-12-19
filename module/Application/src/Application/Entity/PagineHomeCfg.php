<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagineHomeCfg
 *
 * @ORM\Table(name="pagine_home_cfg")
 * @ORM\Entity
 */
class PagineHomeCfg
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
     * @ORM\Column(name="lbl_content", type="string", length=80, nullable=false)
     */
    private $lblContent;

    /**
     * @var string
     *
     * @ORM\Column(name="lbl_boxinfo", type="string", length=80, nullable=false)
     */
    private $lblBoxinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="lbl_boxfree", type="string", length=70, nullable=false)
     */
    private $lblBoxfree;

    /**
     * @var string
     *
     * @ORM\Column(name="lbl_paginhome", type="string", length=80, nullable=false)
     */
    private $lblPaginhome;

    /**
     * @var string
     *
     * @ORM\Column(name="lbl_faq", type="string", length=80, nullable=false)
     */
    private $lblFaq;

    /**
     * @var string
     *
     * @ORM\Column(name="lbl_picday", type="string", length=80, nullable=false)
     */
    private $lblPicday;

    /**
     * @var string
     *
     * @ORM\Column(name="lbll_aste", type="string", length=80, nullable=false)
     */
    private $lbllAste;

    /**
     * @var string
     *
     * @ORM\Column(name="lbl_vetr", type="string", length=80, nullable=false)
     */
    private $lblVetr;

    /**
     * @var string
     *
     * @ORM\Column(name="lbl_video", type="string", length=80, nullable=false)
     */
    private $lblVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="titlebox", type="string", nullable=false)
     */
    private $titlebox = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="widthtablemain", type="string", length=60, nullable=false)
     */
    private $widthtablemain = '98%';

    /**
     * @var integer
     *
     * @ORM\Column(name="picday_width", type="integer", nullable=false)
     */
    private $picdayWidth = '150';

    /**
     * @var integer
     *
     * @ORM\Column(name="picday_height", type="integer", nullable=false)
     */
    private $picdayHeight = '150';

    /**
     * @var string
     *
     * @ORM\Column(name="riquadribox", type="string", nullable=false)
     */
    private $riquadribox = 'si';

    /**
     * @var integer
     *
     * @ORM\Column(name="cols", type="integer", nullable=false)
     */
    private $cols = '0';



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
     * Set lblContent
     *
     * @param string $lblContent
     * @return PagineHomeCfg
     */
    public function setLblContent($lblContent)
    {
        $this->lblContent = $lblContent;

        return $this;
    }

    /**
     * Get lblContent
     *
     * @return string 
     */
    public function getLblContent()
    {
        return $this->lblContent;
    }

    /**
     * Set lblBoxinfo
     *
     * @param string $lblBoxinfo
     * @return PagineHomeCfg
     */
    public function setLblBoxinfo($lblBoxinfo)
    {
        $this->lblBoxinfo = $lblBoxinfo;

        return $this;
    }

    /**
     * Get lblBoxinfo
     *
     * @return string 
     */
    public function getLblBoxinfo()
    {
        return $this->lblBoxinfo;
    }

    /**
     * Set lblBoxfree
     *
     * @param string $lblBoxfree
     * @return PagineHomeCfg
     */
    public function setLblBoxfree($lblBoxfree)
    {
        $this->lblBoxfree = $lblBoxfree;

        return $this;
    }

    /**
     * Get lblBoxfree
     *
     * @return string 
     */
    public function getLblBoxfree()
    {
        return $this->lblBoxfree;
    }

    /**
     * Set lblPaginhome
     *
     * @param string $lblPaginhome
     * @return PagineHomeCfg
     */
    public function setLblPaginhome($lblPaginhome)
    {
        $this->lblPaginhome = $lblPaginhome;

        return $this;
    }

    /**
     * Get lblPaginhome
     *
     * @return string 
     */
    public function getLblPaginhome()
    {
        return $this->lblPaginhome;
    }

    /**
     * Set lblFaq
     *
     * @param string $lblFaq
     * @return PagineHomeCfg
     */
    public function setLblFaq($lblFaq)
    {
        $this->lblFaq = $lblFaq;

        return $this;
    }

    /**
     * Get lblFaq
     *
     * @return string 
     */
    public function getLblFaq()
    {
        return $this->lblFaq;
    }

    /**
     * Set lblPicday
     *
     * @param string $lblPicday
     * @return PagineHomeCfg
     */
    public function setLblPicday($lblPicday)
    {
        $this->lblPicday = $lblPicday;

        return $this;
    }

    /**
     * Get lblPicday
     *
     * @return string 
     */
    public function getLblPicday()
    {
        return $this->lblPicday;
    }

    /**
     * Set lbllAste
     *
     * @param string $lbllAste
     * @return PagineHomeCfg
     */
    public function setLbllAste($lbllAste)
    {
        $this->lbllAste = $lbllAste;

        return $this;
    }

    /**
     * Get lbllAste
     *
     * @return string 
     */
    public function getLbllAste()
    {
        return $this->lbllAste;
    }

    /**
     * Set lblVetr
     *
     * @param string $lblVetr
     * @return PagineHomeCfg
     */
    public function setLblVetr($lblVetr)
    {
        $this->lblVetr = $lblVetr;

        return $this;
    }

    /**
     * Get lblVetr
     *
     * @return string 
     */
    public function getLblVetr()
    {
        return $this->lblVetr;
    }

    /**
     * Set lblVideo
     *
     * @param string $lblVideo
     * @return PagineHomeCfg
     */
    public function setLblVideo($lblVideo)
    {
        $this->lblVideo = $lblVideo;

        return $this;
    }

    /**
     * Get lblVideo
     *
     * @return string 
     */
    public function getLblVideo()
    {
        return $this->lblVideo;
    }

    /**
     * Set titlebox
     *
     * @param string $titlebox
     * @return PagineHomeCfg
     */
    public function setTitlebox($titlebox)
    {
        $this->titlebox = $titlebox;

        return $this;
    }

    /**
     * Get titlebox
     *
     * @return string 
     */
    public function getTitlebox()
    {
        return $this->titlebox;
    }

    /**
     * Set widthtablemain
     *
     * @param string $widthtablemain
     * @return PagineHomeCfg
     */
    public function setWidthtablemain($widthtablemain)
    {
        $this->widthtablemain = $widthtablemain;

        return $this;
    }

    /**
     * Get widthtablemain
     *
     * @return string 
     */
    public function getWidthtablemain()
    {
        return $this->widthtablemain;
    }

    /**
     * Set picdayWidth
     *
     * @param integer $picdayWidth
     * @return PagineHomeCfg
     */
    public function setPicdayWidth($picdayWidth)
    {
        $this->picdayWidth = $picdayWidth;

        return $this;
    }

    /**
     * Get picdayWidth
     *
     * @return integer 
     */
    public function getPicdayWidth()
    {
        return $this->picdayWidth;
    }

    /**
     * Set picdayHeight
     *
     * @param integer $picdayHeight
     * @return PagineHomeCfg
     */
    public function setPicdayHeight($picdayHeight)
    {
        $this->picdayHeight = $picdayHeight;

        return $this;
    }

    /**
     * Get picdayHeight
     *
     * @return integer 
     */
    public function getPicdayHeight()
    {
        return $this->picdayHeight;
    }

    /**
     * Set riquadribox
     *
     * @param string $riquadribox
     * @return PagineHomeCfg
     */
    public function setRiquadribox($riquadribox)
    {
        $this->riquadribox = $riquadribox;

        return $this;
    }

    /**
     * Get riquadribox
     *
     * @return string 
     */
    public function getRiquadribox()
    {
        return $this->riquadribox;
    }

    /**
     * Set cols
     *
     * @param integer $cols
     * @return PagineHomeCfg
     */
    public function setCols($cols)
    {
        $this->cols = $cols;

        return $this;
    }

    /**
     * Get cols
     *
     * @return integer 
     */
    public function getCols()
    {
        return $this->cols;
    }
}
