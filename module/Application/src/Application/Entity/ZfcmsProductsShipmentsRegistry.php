<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsProductsShipmentsRegistry
 *
 * @ORM\Table(name="zfcms_products_shipments_registry")
 * @ORM\Entity
 */
class ZfcmsProductsShipmentsRegistry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=50, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=true)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="address_number", type="integer", nullable=true)
     */
    private $addressNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="cap", type="string", length=50, nullable=true)
     */
    private $cap;

    /**
     * @var integer
     *
     * @ORM\Column(name="citta_id", type="integer", nullable=true)
     */
    private $cittaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="provincia_id", type="integer", nullable=true)
     */
    private $provinciaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="nazione_id", type="integer", nullable=true)
     */
    private $nazioneId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordine_id", type="integer", nullable=true)
     */
    private $ordineId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=50, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=true)
     */
    private $message;

    /**
     * @var integer
     *
     * @ORM\Column(name="spedizione_id", type="integer", nullable=true)
     */
    private $spedizioneId;



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
     * Set name
     *
     * @param string $name
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set addressNumber
     *
     * @param integer $addressNumber
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setAddressNumber($addressNumber)
    {
        $this->addressNumber = $addressNumber;
    
        return $this;
    }

    /**
     * Get addressNumber
     *
     * @return integer
     */
    public function getAddressNumber()
    {
        return $this->addressNumber;
    }

    /**
     * Set cap
     *
     * @param string $cap
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setCap($cap)
    {
        $this->cap = $cap;
    
        return $this;
    }

    /**
     * Get cap
     *
     * @return string
     */
    public function getCap()
    {
        return $this->cap;
    }

    /**
     * Set cittaId
     *
     * @param integer $cittaId
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setCittaId($cittaId)
    {
        $this->cittaId = $cittaId;
    
        return $this;
    }

    /**
     * Get cittaId
     *
     * @return integer
     */
    public function getCittaId()
    {
        return $this->cittaId;
    }

    /**
     * Set provinciaId
     *
     * @param integer $provinciaId
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setProvinciaId($provinciaId)
    {
        $this->provinciaId = $provinciaId;
    
        return $this;
    }

    /**
     * Get provinciaId
     *
     * @return integer
     */
    public function getProvinciaId()
    {
        return $this->provinciaId;
    }

    /**
     * Set nazioneId
     *
     * @param integer $nazioneId
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setNazioneId($nazioneId)
    {
        $this->nazioneId = $nazioneId;
    
        return $this;
    }

    /**
     * Get nazioneId
     *
     * @return integer
     */
    public function getNazioneId()
    {
        return $this->nazioneId;
    }

    /**
     * Set ordineId
     *
     * @param integer $ordineId
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setOrdineId($ordineId)
    {
        $this->ordineId = $ordineId;
    
        return $this;
    }

    /**
     * Get ordineId
     *
     * @return integer
     */
    public function getOrdineId()
    {
        return $this->ordineId;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ZfcmsProductsShipmentsRegistry
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
     * Set message
     *
     * @param string $message
     *
     * @return ZfcmsProductsShipmentsRegistry
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
     * Set spedizioneId
     *
     * @param integer $spedizioneId
     *
     * @return ZfcmsProductsShipmentsRegistry
     */
    public function setSpedizioneId($spedizioneId)
    {
        $this->spedizioneId = $spedizioneId;
    
        return $this;
    }

    /**
     * Get spedizioneId
     *
     * @return integer
     */
    public function getSpedizioneId()
    {
        return $this->spedizioneId;
    }
}
