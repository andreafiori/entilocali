<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsersSettori
 *
 * @ORM\Table(name="zfcms_users_settori", indexes={@ORM\Index(name="fk_responsabile_user_id_settori", columns={"responsabile_user_id"})})
 * @ORM\Entity
 */
class ZfcmsUsersSettori
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
     * @ORM\Column(name="nome", type="string", length=150, nullable=true)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="stato", type="integer", nullable=true)
     */
    private $stato;

    /**
     * @var \Application\Entity\ZfcmsUsers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="responsabile_user_id", referencedColumnName="id")
     * })
     */
    private $responsabileUser;



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
     * Set nome
     *
     * @param string $nome
     * @return ZfcmsUsersSettori
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
     * Set stato
     *
     * @param integer $stato
     * @return ZfcmsUsersSettori
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    
        return $this;
    }

    /**
     * Get stato
     *
     * @return integer 
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * Set responsabileUser
     *
     * @param \Application\Entity\ZfcmsUsers $responsabileUser
     * @return ZfcmsUsersSettori
     */
    public function setResponsabileUser(\Application\Entity\ZfcmsUsers $responsabileUser = null)
    {
        $this->responsabileUser = $responsabileUser;
    
        return $this;
    }

    /**
     * Get responsabileUser
     *
     * @return \Application\Entity\ZfcmsUsers 
     */
    public function getResponsabileUser()
    {
        return $this->responsabileUser;
    }
}
