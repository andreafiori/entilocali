<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relations
 *
 * @ORM\Table(name="relations")
 * @ORM\Entity
 */
class Relations
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
     * @ORM\Column(name="rifcat", type="integer", nullable=false)
     */
    private $rifcat = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifid", type="integer", nullable=false)
     */
    private $rifid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifidattachment", type="integer", nullable=false)
     */
    private $rifidattachment = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifmodule", type="integer", nullable=false)
     */
    private $rifmodule = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="riflanguage", type="integer", nullable=false)
     */
    private $riflanguage = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifchannel", type="integer", nullable=false)
     */
    private $rifchannel = '1';



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
     * Set rifcat
     *
     * @param integer $rifcat
     * @return Relations
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
     * Set rifid
     *
     * @param integer $rifid
     * @return Relations
     */
    public function setRifid($rifid)
    {
        $this->rifid = $rifid;

        return $this;
    }

    /**
     * Get rifid
     *
     * @return integer 
     */
    public function getRifid()
    {
        return $this->rifid;
    }

    /**
     * Set rifidattachment
     *
     * @param integer $rifidattachment
     * @return Relations
     */
    public function setRifidattachment($rifidattachment)
    {
        $this->rifidattachment = $rifidattachment;

        return $this;
    }

    /**
     * Get rifidattachment
     *
     * @return integer 
     */
    public function getRifidattachment()
    {
        return $this->rifidattachment;
    }

    /**
     * Set rifmodule
     *
     * @param integer $rifmodule
     * @return Relations
     */
    public function setRifmodule($rifmodule)
    {
        $this->rifmodule = $rifmodule;

        return $this;
    }

    /**
     * Get rifmodule
     *
     * @return integer 
     */
    public function getRifmodule()
    {
        return $this->rifmodule;
    }

    /**
     * Set riflanguage
     *
     * @param integer $riflanguage
     * @return Relations
     */
    public function setRiflanguage($riflanguage)
    {
        $this->riflanguage = $riflanguage;

        return $this;
    }

    /**
     * Get riflanguage
     *
     * @return integer 
     */
    public function getRiflanguage()
    {
        return $this->riflanguage;
    }

    /**
     * Set rifchannel
     *
     * @param integer $rifchannel
     * @return Relations
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
