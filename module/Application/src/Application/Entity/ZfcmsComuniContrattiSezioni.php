<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiSezioni
 *
 * @ORM\Table(name="zfcms_comuni_contratti_sezioni")
 * @ORM\Entity
 */
class ZfcmsComuniContrattiSezioni
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
     * @ORM\Column(name="nome", type="text", length=65535, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabile", type="text", length=65535, nullable=true)
     */
    private $responsabile;

    /**
     * @var integer
     *
     * @ORM\Column(name="predefinita", type="integer", nullable=true)
     */
    private $predefinita;

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo;



    /**
     * Get id.
    
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome.
    
     *
     * @param string $nome
     *
     * @return ZfcmsComuniContrattiSezioni
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome.
    
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set responsabile.
    
     *
     * @param string $responsabile
     *
     * @return ZfcmsComuniContrattiSezioni
     */
    public function setResponsabile($responsabile)
    {
        $this->responsabile = $responsabile;
    
        return $this;
    }

    /**
     * Get responsabile.
    
     *
     * @return string
     */
    public function getResponsabile()
    {
        return $this->responsabile;
    }

    /**
     * Set predefinita.
    
     *
     * @param integer $predefinita
     *
     * @return ZfcmsComuniContrattiSezioni
     */
    public function setPredefinita($predefinita)
    {
        $this->predefinita = $predefinita;
    
        return $this;
    }

    /**
     * Get predefinita.
    
     *
     * @return integer
     */
    public function getPredefinita()
    {
        return $this->predefinita;
    }

    /**
     * Set attivo.
    
     *
     * @param integer $attivo
     *
     * @return ZfcmsComuniContrattiSezioni
     */
    public function setAttivo($attivo)
    {
        $this->attivo = $attivo;
    
        return $this;
    }

    /**
     * Get attivo.
    
     *
     * @return integer
     */
    public function getAttivo()
    {
        return $this->attivo;
    }
}
