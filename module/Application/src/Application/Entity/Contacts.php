<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacts
 *
 * @ORM\Table(name="contacts", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Contacts
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
     * @ORM\Column(name="nome", type="string", length=80, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cognome", type="string", length=80, nullable=true)
     */
    private $cognome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=80, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datainsert", type="datetime", nullable=true)
     */
    private $datainsert;

    /**
     * @var string
     *
     * @ORM\Column(name="formtype", type="string", length=50, nullable=true)
     */
    private $formtype = 'contact';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="fileattached", type="string", length=255, nullable=true)
     */
    private $fileattached;

    /**
     * @var \Application\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * @return Contacts
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
     * Set cognome
     *
     * @param string $cognome
     * @return Contacts
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;

        return $this;
    }

    /**
     * Get cognome
     *
     * @return string 
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contacts
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Contacts
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Contacts
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set datainsert
     *
     * @param \DateTime $datainsert
     * @return Contacts
     */
    public function setDatainsert($datainsert)
    {
        $this->datainsert = $datainsert;

        return $this;
    }

    /**
     * Get datainsert
     *
     * @return \DateTime 
     */
    public function getDatainsert()
    {
        return $this->datainsert;
    }

    /**
     * Set formtype
     *
     * @param string $formtype
     * @return Contacts
     */
    public function setFormtype($formtype)
    {
        $this->formtype = $formtype;

        return $this;
    }

    /**
     * Get formtype
     *
     * @return string 
     */
    public function getFormtype()
    {
        return $this->formtype;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Contacts
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set fileattached
     *
     * @param string $fileattached
     * @return Contacts
     */
    public function setFileattached($fileattached)
    {
        $this->fileattached = $fileattached;

        return $this;
    }

    /**
     * Get fileattached
     *
     * @return string 
     */
    public function getFileattached()
    {
        return $this->fileattached;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\Users $user
     * @return Contacts
     */
    public function setUser(\Application\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\Users 
     */
    public function getUser()
    {
        return $this->user;
    }
}
