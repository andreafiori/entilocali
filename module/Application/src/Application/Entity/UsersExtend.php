<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersExtend
 *
 * @ORM\Table(name="users_extend")
 * @ORM\Entity
 */
class UsersExtend
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
     * @ORM\Column(name="nomeazienda", type="string", length=50, nullable=true)
     */
    private $nomeazienda;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="orarioapertura", type="time", nullable=true)
     */
    private $orarioapertura;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="orariochiusura", type="time", nullable=true)
     */
    private $orariochiusura;



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
     * Set nomeazienda
     *
     * @param string $nomeazienda
     * @return UsersExtend
     */
    public function setNomeazienda($nomeazienda)
    {
        $this->nomeazienda = $nomeazienda;

        return $this;
    }

    /**
     * Get nomeazienda
     *
     * @return string 
     */
    public function getNomeazienda()
    {
        return $this->nomeazienda;
    }

    /**
     * Set orarioapertura
     *
     * @param \DateTime $orarioapertura
     * @return UsersExtend
     */
    public function setOrarioapertura($orarioapertura)
    {
        $this->orarioapertura = $orarioapertura;

        return $this;
    }

    /**
     * Get orarioapertura
     *
     * @return \DateTime 
     */
    public function getOrarioapertura()
    {
        return $this->orarioapertura;
    }

    /**
     * Set orariochiusura
     *
     * @param \DateTime $orariochiusura
     * @return UsersExtend
     */
    public function setOrariochiusura($orariochiusura)
    {
        $this->orariochiusura = $orariochiusura;

        return $this;
    }

    /**
     * Get orariochiusura
     *
     * @return \DateTime 
     */
    public function getOrariochiusura()
    {
        return $this->orariochiusura;
    }
}
