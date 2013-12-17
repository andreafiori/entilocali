<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiFatture
 *
 * @ORM\Table(name="prodotti_fatture")
 * @ORM\Entity
 */
class ProdottiFatture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idinvoice", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idinvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="invoicecause", type="string", length=100, nullable=false)
     */
    private $invoicecause = '0';



    /**
     * Get idinvoice
     *
     * @return integer 
     */
    public function getIdinvoice()
    {
        return $this->idinvoice;
    }

    /**
     * Set invoicecause
     *
     * @param string $invoicecause
     * @return ProdottiFatture
     */
    public function setInvoicecause($invoicecause)
    {
        $this->invoicecause = $invoicecause;

        return $this;
    }

    /**
     * Get invoicecause
     *
     * @return string 
     */
    public function getInvoicecause()
    {
        return $this->invoicecause;
    }
}
