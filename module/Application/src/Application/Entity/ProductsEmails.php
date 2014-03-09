<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsEmails
 *
 * @ORM\Table(name="products_emails")
 * @ORM\Entity
 */
class ProductsEmails
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contatti", type="string", length=100, nullable=false)
     */
    private $contatti;

    /**
     * @var string
     *
     * @ORM\Column(name="consiglia", type="string", length=100, nullable=false)
     */
    private $consiglia;

    /**
     * @var string
     *
     * @ORM\Column(name="ric_prezzo", type="string", length=100, nullable=false)
     */
    private $ricPrezzo;

    /**
     * @var string
     *
     * @ORM\Column(name="ric_ordini", type="string", length=100, nullable=false)
     */
    private $ricOrdini;



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
     * Set contatti
     *
     * @param string $contatti
     * @return ProductsEmails
     */
    public function setContatti($contatti)
    {
        $this->contatti = $contatti;

        return $this;
    }

    /**
     * Get contatti
     *
     * @return string 
     */
    public function getContatti()
    {
        return $this->contatti;
    }

    /**
     * Set consiglia
     *
     * @param string $consiglia
     * @return ProductsEmails
     */
    public function setConsiglia($consiglia)
    {
        $this->consiglia = $consiglia;

        return $this;
    }

    /**
     * Get consiglia
     *
     * @return string 
     */
    public function getConsiglia()
    {
        return $this->consiglia;
    }

    /**
     * Set ricPrezzo
     *
     * @param string $ricPrezzo
     * @return ProductsEmails
     */
    public function setRicPrezzo($ricPrezzo)
    {
        $this->ricPrezzo = $ricPrezzo;

        return $this;
    }

    /**
     * Get ricPrezzo
     *
     * @return string 
     */
    public function getRicPrezzo()
    {
        return $this->ricPrezzo;
    }

    /**
     * Set ricOrdini
     *
     * @param string $ricOrdini
     * @return ProductsEmails
     */
    public function setRicOrdini($ricOrdini)
    {
        $this->ricOrdini = $ricOrdini;

        return $this;
    }

    /**
     * Get ricOrdini
     *
     * @return string 
     */
    public function getRicOrdini()
    {
        return $this->ricOrdini;
    }
}
