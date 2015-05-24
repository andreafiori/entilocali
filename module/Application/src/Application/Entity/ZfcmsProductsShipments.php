<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsProductsShipments
 *
 * @ORM\Table(name="zfcms_products_shipments")
 * @ORM\Entity
 */
class ZfcmsProductsShipments
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="costo_euro", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $costoEuro;

    /**
     * @var string
     *
     * @ORM\Column(name="costo_nazionale", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $costoNazionale;

    /**
     * @var string
     *
     * @ORM\Column(name="costo_internaz", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $costoInternaz;

    /**
     * @var string
     *
     * @ORM\Column(name="tempo_medio", type="string", length=50, nullable=true)
     */
    private $tempoMedio;



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
     * Set nome
     *
     * @param string $nome
     *
     * @return ZfcmsProductsShipments
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set costoEuro
     *
     * @param string $costoEuro
     *
     * @return ZfcmsProductsShipments
     */
    public function setCostoEuro($costoEuro)
    {
        $this->costoEuro = $costoEuro;
    
        return $this;
    }

    /**
     * Get costoEuro
     *
     * @return string
     */
    public function getCostoEuro()
    {
        return $this->costoEuro;
    }

    /**
     * Set costoNazionale
     *
     * @param string $costoNazionale
     *
     * @return ZfcmsProductsShipments
     */
    public function setCostoNazionale($costoNazionale)
    {
        $this->costoNazionale = $costoNazionale;
    
        return $this;
    }

    /**
     * Get costoNazionale
     *
     * @return string
     */
    public function getCostoNazionale()
    {
        return $this->costoNazionale;
    }

    /**
     * Set costoInternaz
     *
     * @param string $costoInternaz
     *
     * @return ZfcmsProductsShipments
     */
    public function setCostoInternaz($costoInternaz)
    {
        $this->costoInternaz = $costoInternaz;
    
        return $this;
    }

    /**
     * Get costoInternaz
     *
     * @return string
     */
    public function getCostoInternaz()
    {
        return $this->costoInternaz;
    }

    /**
     * Set tempoMedio
     *
     * @param string $tempoMedio
     *
     * @return ZfcmsProductsShipments
     */
    public function setTempoMedio($tempoMedio)
    {
        $this->tempoMedio = $tempoMedio;
    
        return $this;
    }

    /**
     * Get tempoMedio
     *
     * @return string
     */
    public function getTempoMedio()
    {
        return $this->tempoMedio;
    }
}
