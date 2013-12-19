<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Languages
 *
 * @ORM\Table(name="languages", indexes={@ORM\Index(name="abbrev1", columns={"abbrev1"})})
 * @ORM\Entity
 */
class Languages
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
     * @ORM\Column(name="language", type="string", length=100, nullable=false)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="abbrev1", type="string", length=60, nullable=false)
     */
    private $abbrev1;

    /**
     * @var string
     *
     * @ORM\Column(name="abbrev2", type="string", length=60, nullable=false)
     */
    private $abbrev2;

    /**
     * @var string
     *
     * @ORM\Column(name="abbrev3", type="string", length=60, nullable=false)
     */
    private $abbrev3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultlang", type="boolean", nullable=false)
     */
    private $defaultlang = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultlang_admin", type="boolean", nullable=false)
     */
    private $defaultlangAdmin = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="encoding", type="string", length=50, nullable=true)
     */
    private $encoding = 'UTF-8';

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=60, nullable=false)
     */
    private $flag;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active = '1';

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
     * Set language
     *
     * @param string $language
     * @return Languages
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set abbrev1
     *
     * @param string $abbrev1
     * @return Languages
     */
    public function setAbbrev1($abbrev1)
    {
        $this->abbrev1 = $abbrev1;

        return $this;
    }

    /**
     * Get abbrev1
     *
     * @return string 
     */
    public function getAbbrev1()
    {
        return $this->abbrev1;
    }

    /**
     * Set abbrev2
     *
     * @param string $abbrev2
     * @return Languages
     */
    public function setAbbrev2($abbrev2)
    {
        $this->abbrev2 = $abbrev2;

        return $this;
    }

    /**
     * Get abbrev2
     *
     * @return string 
     */
    public function getAbbrev2()
    {
        return $this->abbrev2;
    }

    /**
     * Set abbrev3
     *
     * @param string $abbrev3
     * @return Languages
     */
    public function setAbbrev3($abbrev3)
    {
        $this->abbrev3 = $abbrev3;

        return $this;
    }

    /**
     * Get abbrev3
     *
     * @return string 
     */
    public function getAbbrev3()
    {
        return $this->abbrev3;
    }

    /**
     * Set defaultlang
     *
     * @param boolean $defaultlang
     * @return Languages
     */
    public function setDefaultlang($defaultlang)
    {
        $this->defaultlang = $defaultlang;

        return $this;
    }

    /**
     * Get defaultlang
     *
     * @return boolean 
     */
    public function getDefaultlang()
    {
        return $this->defaultlang;
    }

    /**
     * Set defaultlangAdmin
     *
     * @param boolean $defaultlangAdmin
     * @return Languages
     */
    public function setDefaultlangAdmin($defaultlangAdmin)
    {
        $this->defaultlangAdmin = $defaultlangAdmin;

        return $this;
    }

    /**
     * Get defaultlangAdmin
     *
     * @return boolean 
     */
    public function getDefaultlangAdmin()
    {
        return $this->defaultlangAdmin;
    }

    /**
     * Set encoding
     *
     * @param string $encoding
     * @return Languages
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Get encoding
     *
     * @return string 
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set flag
     *
     * @param string $flag
     * @return Languages
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return Languages
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set channelId
     *
     * @param integer $channelId
     * @return Languages
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
