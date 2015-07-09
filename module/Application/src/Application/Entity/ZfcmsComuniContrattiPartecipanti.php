<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiPartecipanti
 *
 * @ORM\Table(name="zfcms_comuni_contratti_partecipanti", indexes={@ORM\Index(name="categoria", columns={"categoria"}), @ORM\Index(name="sel", columns={"sel"})})
 * @ORM\Entity
 */
class ZfcmsComuniContrattiPartecipanti
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
     * @ORM\Column(name="cf", type="text", length=65535, nullable=false)
     */
    private $cf;

    /**
     * @var string
     *
     * @ORM\Column(name="ragione_sociale", type="text", length=65535, nullable=false)
     */
    private $ragioneSociale;

    /**
     * @var string
     *
     * @ORM\Column(name="ruolo1", type="text", length=65535, nullable=false)
     */
    private $ruolo1;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="text", length=65535, nullable=false)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="bigint", nullable=true)
     */
    private $posizione = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria", type="bigint", nullable=true)
     */
    private $categoria = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="sel", type="bigint", nullable=false)
     */
    private $sel = '0';



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
     * Set cf
     *
     * @param string $cf
     *
     * @return ZfcmsComuniContrattiPartecipanti
     */
    public function setCf($cf)
    {
        $this->cf = $cf;
    
        return $this;
    }

    /**
     * Get cf
     *
     * @return string
     */
    public function getCf()
    {
        return $this->cf;
    }

    /**
     * Set ragioneSociale
     *
     * @param string $ragioneSociale
     *
     * @return ZfcmsComuniContrattiPartecipanti
     */
    public function setRagioneSociale($ragioneSociale)
    {
        $this->ragioneSociale = $ragioneSociale;
    
        return $this;
    }

    /**
     * Get ragioneSociale
     *
     * @return string
     */
    public function getRagioneSociale()
    {
        return $this->ragioneSociale;
    }

    /**
     * Set ruolo1
     *
     * @param string $ruolo1
     *
     * @return ZfcmsComuniContrattiPartecipanti
     */
    public function setRuolo1($ruolo1)
    {
        $this->ruolo1 = $ruolo1;
    
        return $this;
    }

    /**
     * Get ruolo1
     *
     * @return string
     */
    public function getRuolo1()
    {
        return $this->ruolo1;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return ZfcmsComuniContrattiPartecipanti
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
     * Set posizione
     *
     * @param integer $posizione
     *
     * @return ZfcmsComuniContrattiPartecipanti
     */
    public function setPosizione($posizione)
    {
        $this->posizione = $posizione;
    
        return $this;
    }

    /**
     * Get posizione
     *
     * @return integer
     */
    public function getPosizione()
    {
        return $this->posizione;
    }

    /**
     * Set categoria
     *
     * @param integer $categoria
     *
     * @return ZfcmsComuniContrattiPartecipanti
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set sel
     *
     * @param integer $sel
     *
     * @return ZfcmsComuniContrattiPartecipanti
     */
    public function setSel($sel)
    {
        $this->sel = $sel;
    
        return $this;
    }

    /**
     * Get sel
     *
     * @return integer
     */
    public function getSel()
    {
        return $this->sel;
    }
}
