<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoComuniCap
 *
 * @ORM\Table(name="geo_comuni_cap", uniqueConstraints={@ORM\UniqueConstraint(name="capcode", columns={"capcode"})}, indexes={@ORM\Index(name="comune_id", columns={"comune_id"})})
 * @ORM\Entity
 */
class GeoComuniCap
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
     * @ORM\Column(name="capcode", type="string", length=5, nullable=false)
     */
    private $capcode = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=80, nullable=false)
     */
    private $nome = '0';

    /**
     * @var \Application\Entity\GeoComuni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\GeoComuni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comune_id", referencedColumnName="id")
     * })
     */
    private $comune;



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
     * Set capcode
     *
     * @param string $capcode
     *
     * @return GeoComuniCap
     */
    public function setCapcode($capcode)
    {
        $this->capcode = $capcode;
    
        return $this;
    }

    /**
     * Get capcode
     *
     * @return string
     */
    public function getCapcode()
    {
        return $this->capcode;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return GeoComuniCap
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
     * Set comune
     *
     * @param \Application\Entity\GeoComuni $comune
     *
     * @return GeoComuniCap
     */
    public function setComune(\Application\Entity\GeoComuni $comune = null)
    {
        $this->comune = $comune;
    
        return $this;
    }

    /**
     * Get comune
     *
     * @return \Application\Entity\GeoComuni
     */
    public function getComune()
    {
        return $this->comune;
    }
}
