<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoRegioni
 *
 * @ORM\Table(name="geo_regioni", indexes={@ORM\Index(name="cod_regione", columns={"cod_regione"})})
 * @ORM\Entity
 */
class GeoRegioni
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
     * @ORM\Column(name="cod_regione", type="string", length=2, nullable=false)
     */
    private $codRegione;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeregione", type="string", length=100, nullable=false)
     */
    private $nomeregione;



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
     * Set codRegione
     *
     * @param string $codRegione
     * @return GeoRegioni
     */
    public function setCodRegione($codRegione)
    {
        $this->codRegione = $codRegione;

        return $this;
    }

    /**
     * Get codRegione
     *
     * @return string 
     */
    public function getCodRegione()
    {
        return $this->codRegione;
    }

    /**
     * Set nomeregione
     *
     * @param string $nomeregione
     * @return GeoRegioni
     */
    public function setNomeregione($nomeregione)
    {
        $this->nomeregione = $nomeregione;

        return $this;
    }

    /**
     * Get nomeregione
     *
     * @return string 
     */
    public function getNomeregione()
    {
        return $this->nomeregione;
    }
}
