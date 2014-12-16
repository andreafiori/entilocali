<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsGeoComuniCap
 *
 * @ORM\Table(name="zfcms_geo_comuni_cap", uniqueConstraints={@ORM\UniqueConstraint(name="capcode", columns={"capcode"})}, indexes={@ORM\Index(name="comune_id", columns={"comune_id"})})
 * @ORM\Entity
 */
class ZfcmsGeoComuniCap
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
    private $capcode;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=80, nullable=false)
     */
    private $nome;

    /**
     * @var \Application\Entity\ZfcmsGeoComuni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsGeoComuni")
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
     * @return ZfcmsGeoComuniCap
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
     * @return ZfcmsGeoComuniCap
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
     * @param \Application\Entity\ZfcmsGeoComuni $comune
     *
     * @return ZfcmsGeoComuniCap
     */
    public function setComune(\Application\Entity\ZfcmsGeoComuni $comune = null)
    {
        $this->comune = $comune;
    
        return $this;
    }

    /**
     * Get comune
     *
     * @return \Application\Entity\ZfcmsGeoComuni
     */
    public function getComune()
    {
        return $this->comune;
    }
}
