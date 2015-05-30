<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsProductsShipmentsTypes
 *
 * @ORM\Table(name="zfcms_products_shipments_types")
 * @ORM\Entity
 */
class ZfcmsProductsShipmentsTypes
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
     * @ORM\Column(name="area_di_consegna", type="string", length=100, nullable=true)
     */
    private $areaDiConsegna;

    /**
     * @var string
     *
     * @ORM\Column(name="ordine_minimo", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ordineMinimo;

    /**
     * @var string
     *
     * @ORM\Column(name="tempo_medio_consegna", type="string", length=50, nullable=true)
     */
    private $tempoMedioConsegna;



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
     * Set areaDiConsegna
     *
     * @param string $areaDiConsegna
     * @return ZfcmsProductsShipmentsTypes
     */
    public function setAreaDiConsegna($areaDiConsegna)
    {
        $this->areaDiConsegna = $areaDiConsegna;
    
        return $this;
    }

    /**
     * Get areaDiConsegna
     *
     * @return string 
     */
    public function getAreaDiConsegna()
    {
        return $this->areaDiConsegna;
    }

    /**
     * Set ordineMinimo
     *
     * @param string $ordineMinimo
     * @return ZfcmsProductsShipmentsTypes
     */
    public function setOrdineMinimo($ordineMinimo)
    {
        $this->ordineMinimo = $ordineMinimo;
    
        return $this;
    }

    /**
     * Get ordineMinimo
     *
     * @return string 
     */
    public function getOrdineMinimo()
    {
        return $this->ordineMinimo;
    }

    /**
     * Set tempoMedioConsegna
     *
     * @param string $tempoMedioConsegna
     * @return ZfcmsProductsShipmentsTypes
     */
    public function setTempoMedioConsegna($tempoMedioConsegna)
    {
        $this->tempoMedioConsegna = $tempoMedioConsegna;
    
        return $this;
    }

    /**
     * Get tempoMedioConsegna
     *
     * @return string 
     */
    public function getTempoMedioConsegna()
    {
        return $this->tempoMedioConsegna;
    }
}
