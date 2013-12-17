<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiSpedizioniCap
 *
 * @ORM\Table(name="prodotti_spedizioni_cap")
 * @ORM\Entity
 */
class ProdottiSpedizioniCap
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idspedizcap", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idspedizcap;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifidcap", type="integer", nullable=false)
     */
    private $rifidcap = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rifusersazienda", type="integer", nullable=false)
     */
    private $rifusersazienda = '0';



    /**
     * Get idspedizcap
     *
     * @return integer 
     */
    public function getIdspedizcap()
    {
        return $this->idspedizcap;
    }

    /**
     * Set rifidcap
     *
     * @param integer $rifidcap
     * @return ProdottiSpedizioniCap
     */
    public function setRifidcap($rifidcap)
    {
        $this->rifidcap = $rifidcap;

        return $this;
    }

    /**
     * Get rifidcap
     *
     * @return integer 
     */
    public function getRifidcap()
    {
        return $this->rifidcap;
    }

    /**
     * Set rifusersazienda
     *
     * @param integer $rifusersazienda
     * @return ProdottiSpedizioniCap
     */
    public function setRifusersazienda($rifusersazienda)
    {
        $this->rifusersazienda = $rifusersazienda;

        return $this;
    }

    /**
     * Get rifusersazienda
     *
     * @return integer 
     */
    public function getRifusersazienda()
    {
        return $this->rifusersazienda;
    }
}
