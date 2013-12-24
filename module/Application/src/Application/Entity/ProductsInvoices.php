<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsInvoices
 *
 * @ORM\Table(name="products_invoices")
 * @ORM\Entity
 */
class ProductsInvoices
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
     * @ORM\Column(name="invoicecause", type="string", length=100, nullable=false)
     */
    private $invoicecause = '0';



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
     * Set invoicecause
     *
     * @param string $invoicecause
     * @return ProductsInvoices
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
