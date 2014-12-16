<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiScContr
 *
 * @ORM\Table(name="zfcms_comuni_contratti_sc_contr", indexes={@ORM\Index(name="attivo", columns={"attivo"})})
 * @ORM\Entity
 */
class ZfcmsComuniContrattiScContr
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
     * @ORM\Column(name="nome_scelta", type="text", length=65535, nullable=false)
     */
    private $nomeScelta;

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo;



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
     * Set nomeScelta
     *
     * @param string $nomeScelta
     *
     * @return ZfcmsComuniContrattiScContr
     */
    public function setNomeScelta($nomeScelta)
    {
        $this->nomeScelta = $nomeScelta;
    
        return $this;
    }

    /**
     * Get nomeScelta
     *
     * @return string
     */
    public function getNomeScelta()
    {
        return $this->nomeScelta;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     *
     * @return ZfcmsComuniContrattiScContr
     */
    public function setAttivo($attivo)
    {
        $this->attivo = $attivo;
    
        return $this;
    }

    /**
     * Get attivo
     *
     * @return integer
     */
    public function getAttivo()
    {
        return $this->attivo;
    }
}
