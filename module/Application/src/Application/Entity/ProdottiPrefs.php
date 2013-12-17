<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiPrefs
 *
 * @ORM\Table(name="prodotti_prefs")
 * @ORM\Entity
 */
class ProdottiPrefs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idclprod", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclprod;

    /**
     * @var integer
     *
     * @ORM\Column(name="rif_idcl", type="integer", nullable=false)
     */
    private $rifIdcl = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rif_idprod", type="integer", nullable=false)
     */
    private $rifIdprod = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifmodule", type="integer", nullable=false)
     */
    private $rifmodule = '0';



    /**
     * Get idclprod
     *
     * @return integer 
     */
    public function getIdclprod()
    {
        return $this->idclprod;
    }

    /**
     * Set rifIdcl
     *
     * @param integer $rifIdcl
     * @return ProdottiPrefs
     */
    public function setRifIdcl($rifIdcl)
    {
        $this->rifIdcl = $rifIdcl;

        return $this;
    }

    /**
     * Get rifIdcl
     *
     * @return integer 
     */
    public function getRifIdcl()
    {
        return $this->rifIdcl;
    }

    /**
     * Set rifIdprod
     *
     * @param integer $rifIdprod
     * @return ProdottiPrefs
     */
    public function setRifIdprod($rifIdprod)
    {
        $this->rifIdprod = $rifIdprod;

        return $this;
    }

    /**
     * Get rifIdprod
     *
     * @return integer 
     */
    public function getRifIdprod()
    {
        return $this->rifIdprod;
    }

    /**
     * Set rifmodule
     *
     * @param integer $rifmodule
     * @return ProdottiPrefs
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
