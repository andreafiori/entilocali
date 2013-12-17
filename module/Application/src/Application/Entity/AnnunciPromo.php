<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnunciPromo
 *
 * @ORM\Table(name="annunci_promo")
 * @ORM\Entity
 */
class AnnunciPromo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idannpromo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idannpromo;

    /**
     * @var string
     *
     * @ORM\Column(name="nomepromo", type="string", length=50, nullable=true)
     */
    private $nomepromo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="visibpromo", type="string", nullable=true)
     */
    private $visibpromo = 'si';



    /**
     * Get idannpromo
     *
     * @return integer 
     */
    public function getIdannpromo()
    {
        return $this->idannpromo;
    }

    /**
     * Set nomepromo
     *
     * @param string $nomepromo
     * @return AnnunciPromo
     */
    public function setNomepromo($nomepromo)
    {
        $this->nomepromo = $nomepromo;

        return $this;
    }

    /**
     * Get nomepromo
     *
     * @return string 
     */
    public function getNomepromo()
    {
        return $this->nomepromo;
    }

    /**
     * Set visibpromo
     *
     * @param string $visibpromo
     * @return AnnunciPromo
     */
    public function setVisibpromo($visibpromo)
    {
        $this->visibpromo = $visibpromo;

        return $this;
    }

    /**
     * Get visibpromo
     *
     * @return string 
     */
    public function getVisibpromo()
    {
        return $this->visibpromo;
    }
}
