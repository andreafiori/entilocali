<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiRespProc
 *
 * @ORM\Table(name="zfcms_comuni_contratti_resp_proc", indexes={@ORM\Index(name="attivo", columns={"attivo"})})
 * @ORM\Entity
 */
class ZfcmsComuniContrattiRespProc
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
     * @ORM\Column(name="nome_resp", type="text", length=65535, nullable=false)
     */
    private $nomeResp;

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
     * Set nomeResp
     *
     * @param string $nomeResp
     *
     * @return ZfcmsComuniContrattiRespProc
     */
    public function setNomeResp($nomeResp)
    {
        $this->nomeResp = $nomeResp;
    
        return $this;
    }

    /**
     * Get nomeResp
     *
     * @return string
     */
    public function getNomeResp()
    {
        return $this->nomeResp;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     *
     * @return ZfcmsComuniContrattiRespProc
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
