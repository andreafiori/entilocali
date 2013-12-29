<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modules
 *
 * @ORM\Table(name="modules", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="isnews", columns={"isnews"})})
 * @ORM\Entity
 */
class Modules
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
     * @ORM\Column(name="nomemod", type="string", length=100, nullable=false)
     */
    private $nomemod;

    /**
     * @var string
     *
     * @ORM\Column(name="home_label", type="string", length=100, nullable=false)
     */
    private $homeLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="home_category", type="string", length=100, nullable=false)
     */
    private $homeCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="home_css", type="string", length=100, nullable=false)
     */
    private $homeCss;

    /**
     * @var string
     *
     * @ORM\Column(name="home_classcsstabletd", type="string", length=80, nullable=false)
     */
    private $homeClasscsstabletd;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="widthtable", type="string", length=50, nullable=false)
     */
    private $widthtable;

    /**
     * @var integer
     *
     * @ORM\Column(name="highlited", type="integer", nullable=false)
     */
    private $highlited;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="isnews", type="string", nullable=false)
     */
    private $isnews = 'no';

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
     */
    private $channelId = '1';



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
     * Set nomemod
     *
     * @param string $nomemod
     * @return Modules
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
     * Set homeLabel
     *
     * @param string $homeLabel
     * @return Modules
     */
    public function setHomeLabel($homeLabel)
    {
        $this->homeLabel = $homeLabel;

        return $this;
    }

    /**
     * Get homeLabel
     *
     * @return string 
     */
    public function getHomeLabel()
    {
        return $this->homeLabel;
    }

    /**
     * Set homeCategory
     *
     * @param string $homeCategory
     * @return Modules
     */
    public function setHomeCategory($homeCategory)
    {
        $this->homeCategory = $homeCategory;

        return $this;
    }

    /**
     * Get homeCategory
     *
     * @return string 
     */
    public function getHomeCategory()
    {
        return $this->homeCategory;
    }

    /**
     * Set homeCss
     *
     * @param string $homeCss
     * @return Modules
     */
    public function setHomeCss($homeCss)
    {
        $this->homeCss = $homeCss;

        return $this;
    }

    /**
     * Get homeCss
     *
     * @return string 
     */
    public function getHomeCss()
    {
        return $this->homeCss;
    }

    /**
     * Set homeClasscsstabletd
     *
     * @param string $homeClasscsstabletd
     * @return Modules
     */
    public function setHomeClasscsstabletd($homeClasscsstabletd)
    {
        $this->homeClasscsstabletd = $homeClasscsstabletd;

        return $this;
    }

    /**
     * Get homeClasscsstabletd
     *
     * @return string 
     */
    public function getHomeClasscsstabletd()
    {
        return $this->homeClasscsstabletd;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Modules
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
     * Set widthtable
     *
     * @param string $widthtable
     * @return Modules
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
     * Set highlited
     *
     * @param integer $highlited
     * @return Modules
     */
    public function setHighlited($highlited)
    {
        $this->highlited = $highlited;

        return $this;
    }

    /**
     * Get highlited
     *
     * @return integer 
     */
    public function getHighlited()
    {
        return $this->highlited;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Modules
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

    /**
     * Set isnews
     *
     * @param string $isnews
     * @return Modules
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
     * Set channelId
     *
     * @param integer $channelId
     * @return Modules
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Get channelId
     *
     * @return integer 
     */
    public function getChannelId()
    {
        return $this->channelId;
    }
}
