<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiSpedizioniAnagrafica
 *
 * @ORM\Table(name="prodotti_spedizioni_anagrafica", indexes={@ORM\Index(name="shippingidsearch", columns={"order_id", "shipping_id", "nation_id", "province_id", "city_id"})})
 * @ORM\Entity
 */
class ProdottiSpedizioniAnagrafica
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
     * @ORM\Column(name="zip", type="string", length=50, nullable=true)
     */
    private $zip;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer", nullable=true)
     */
    private $cityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="province_id", type="integer", nullable=true)
     */
    private $provinceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="nation_id", type="integer", nullable=true)
     */
    private $nationId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="shipping_id", type="integer", nullable=true)
     */
    private $shippingId;



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
     * @return ProdottiSpedizioniAnagrafica
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
     * @return ProdottiSpedizioniAnagrafica
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
     * @return ProdottiSpedizioniAnagrafica
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
     * @return ProdottiSpedizioniAnagrafica
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
     * Set zip
     *
     * @param string $zip
     * @return ProdottiSpedizioniAnagrafica
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     * @return ProdottiSpedizioniAnagrafica
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer 
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set provinceId
     *
     * @param integer $provinceId
     * @return ProdottiSpedizioniAnagrafica
     */
    public function setProvinceId($provinceId)
    {
        $this->provinceId = $provinceId;

        return $this;
    }

    /**
     * Get provinceId
     *
     * @return integer 
     */
    public function getProvinceId()
    {
        return $this->provinceId;
    }

    /**
     * Set nationId
     *
     * @param integer $nationId
     * @return ProdottiSpedizioniAnagrafica
     */
    public function setNationId($nationId)
    {
        $this->nationId = $nationId;

        return $this;
    }

    /**
     * Get nationId
     *
     * @return integer 
     */
    public function getNationId()
    {
        return $this->nationId;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return ProdottiSpedizioniAnagrafica
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
     * Set email
     *
     * @param string $email
     * @return ProdottiSpedizioniAnagrafica
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
     * @return ProdottiSpedizioniAnagrafica
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
     * Set orderId
     *
     * @param integer $orderId
     * @return ProdottiSpedizioniAnagrafica
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set shippingId
     *
     * @param integer $shippingId
     * @return ProdottiSpedizioniAnagrafica
     */
    public function setShippingId($shippingId)
    {
        $this->shippingId = $shippingId;

        return $this;
    }

    /**
     * Get shippingId
     *
     * @return integer 
     */
    public function getShippingId()
    {
        return $this->shippingId;
    }
}
