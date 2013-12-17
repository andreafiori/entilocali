<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiOrdiniStati
 *
 * @ORM\Table(name="prodotti_ordini_stati")
 * @ORM\Entity
 */
class ProdottiOrdiniStati
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idst", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idst;

    /**
     * @var string
     *
     * @ORM\Column(name="nomestato", type="string", length=50, nullable=true)
     */
    private $nomestato;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=50, nullable=true)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="integer", nullable=true)
     */
    private $posizione;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="predef", type="string", nullable=true)
     */
    private $predef;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifmodule", type="integer", nullable=true)
     */
    private $rifmodule;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifchannel", type="integer", nullable=true)
     */
    private $rifchannel;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;



    /**
     * Get idst
     *
     * @return integer 
     */
    public function getIdst()
    {
        return $this->idst;
    }

    /**
     * Set nomestato
     *
     * @param string $nomestato
     * @return ProdottiOrdiniStati
     */
    public function setNomestato($nomestato)
    {
        $this->nomestato = $nomestato;

        return $this;
    }

    /**
     * Get nomestato
     *
     * @return string 
     */
    public function getNomestato()
    {
        return $this->nomestato;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return ProdottiOrdiniStati
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return ProdottiOrdiniStati
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
     * Set active
     *
     * @param string $active
     * @return ProdottiOrdiniStati
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set predef
     *
     * @param string $predef
     * @return ProdottiOrdiniStati
     */
    public function setPredef($predef)
    {
        $this->predef = $predef;

        return $this;
    }

    /**
     * Get predef
     *
     * @return string 
     */
    public function getPredef()
    {
        return $this->predef;
    }

    /**
     * Set rifmodule
     *
     * @param integer $rifmodule
     * @return ProdottiOrdiniStati
     */
    public function setRifmodule($rifmodule)
    {
        $this->rifmodule = $rifmodule;

        return $this;
    }

    /**
     * Get rifmodule
     *
     * @return integer 
     */
    public function getRifmodule()
    {
        return $this->rifmodule;
    }

    /**
     * Set rifchannel
     *
     * @param integer $rifchannel
     * @return ProdottiOrdiniStati
     */
    public function setRifchannel($rifchannel)
    {
        $this->rifchannel = $rifchannel;

        return $this;
    }

    /**
     * Get rifchannel
     *
     * @return integer 
     */
    public function getRifchannel()
    {
        return $this->rifchannel;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return ProdottiOrdiniStati
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }
}
