<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Categories
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
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="orderfieldname", type="string", length=100, nullable=true)
     */
    private $orderfieldname;

    /**
     * @var string
     *
     * @ORM\Column(name="accesskey", type="string", length=4, nullable=true)
     */
    private $accesskey;

    /**
     * @var string
     *
     * @ORM\Column(name="templatecatfile", type="string", length=100, nullable=true)
     */
    private $templatecatfile;

    /**
     * @var integer
     *
     * @ORM\Column(name="parentid", type="integer", nullable=false)
     */
    private $parentid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="integer", nullable=false)
     */
    private $posizione = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifchannel", type="integer", nullable=false)
     */
    private $rifchannel = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifmodule", type="integer", nullable=false)
     */
    private $rifmodule = '0';



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
     * Set status
     *
     * @param string $status
     * @return Categories
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
     * Set orderfieldname
     *
     * @param string $orderfieldname
     * @return Categories
     */
    public function setOrderfieldname($orderfieldname)
    {
        $this->orderfieldname = $orderfieldname;

        return $this;
    }

    /**
     * Get orderfieldname
     *
     * @return string 
     */
    public function getOrderfieldname()
    {
        return $this->orderfieldname;
    }

    /**
     * Set accesskey
     *
     * @param string $accesskey
     * @return Categories
     */
    public function setAccesskey($accesskey)
    {
        $this->accesskey = $accesskey;

        return $this;
    }

    /**
     * Get accesskey
     *
     * @return string 
     */
    public function getAccesskey()
    {
        return $this->accesskey;
    }

    /**
     * Set templatecatfile
     *
     * @param string $templatecatfile
     * @return Categories
     */
    public function setTemplatecatfile($templatecatfile)
    {
        $this->templatecatfile = $templatecatfile;

        return $this;
    }

    /**
     * Get templatecatfile
     *
     * @return string 
     */
    public function getTemplatecatfile()
    {
        return $this->templatecatfile;
    }

    /**
     * Set parentid
     *
     * @param integer $parentid
     * @return Categories
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;

        return $this;
    }

    /**
     * Get parentid
     *
     * @return integer 
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return Categories
     */
    public function setPosizione($posizione)
    {
        $this->posizione = $posizione;

        return $this;
    }

    /**
     * Get posizione
     *
     * @return integer 
     */
    public function getPosizione()
    {
        return $this->posizione;
    }

    /**
     * Set rifchannel
     *
     * @param integer $rifchannel
     * @return Categories
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

    /**
     * Set rifmodule
     *
     * @param integer $rifmodule
     * @return Categories
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
}
