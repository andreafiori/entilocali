<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtentiPreferiti
 *
 * @ORM\Table(name="utenti_preferiti", indexes={@ORM\Index(name="utente_id", columns={"utente_id"}), @ORM\Index(name="riferimento_id", columns={"riferimento_id"}), @ORM\Index(name="modulo_id", columns={"modulo_id"}), @ORM\Index(name="categoria_id", columns={"categoria_id"})})
 * @ORM\Entity
 */
class UtentiPreferiti
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
     * @var integer
     *
     * @ORM\Column(name="utente_id", type="bigint", nullable=false)
     */
    private $utenteId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="riferimento_id", type="bigint", nullable=false)
     */
    private $riferimentoId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria_id", type="bigint", nullable=false)
     */
    private $categoriaId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_id", type="bigint", nullable=false)
     */
    private $moduloId = '0';



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
     * Set utenteId
     *
     * @param integer $utenteId
     *
     * @return UtentiPreferiti
     */
    public function setUtenteId($utenteId)
    {
        $this->utenteId = $utenteId;
    
        return $this;
    }

    /**
     * Get utenteId
     *
     * @return integer
     */
    public function getUtenteId()
    {
        return $this->utenteId;
    }

    /**
     * Set riferimentoId
     *
     * @param integer $riferimentoId
     *
     * @return UtentiPreferiti
     */
    public function setRiferimentoId($riferimentoId)
    {
        $this->riferimentoId = $riferimentoId;
    
        return $this;
    }

    /**
     * Get riferimentoId
     *
     * @return integer
     */
    public function getRiferimentoId()
    {
        return $this->riferimentoId;
    }

    /**
     * Set categoriaId
     *
     * @param integer $categoriaId
     *
     * @return UtentiPreferiti
     */
    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;
    
        return $this;
    }

    /**
     * Get categoriaId
     *
     * @return integer
     */
    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    /**
     * Set moduloId
     *
     * @param integer $moduloId
     *
     * @return UtentiPreferiti
     */
    public function setModuloId($moduloId)
    {
        $this->moduloId = $moduloId;
    
        return $this;
    }

    /**
     * Get moduloId
     *
     * @return integer
     */
    public function getModuloId()
    {
        return $this->moduloId;
    }
}
