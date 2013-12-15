<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="key_ids", columns={"role_id", "language_id"})})
 * @ORM\Entity
 */
class Users
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
     * @ORM\Column(name="image", type="string", length=80, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=60, nullable=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=60, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="capzip", type="string", length=5, nullable=false)
     */
    private $capzip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=60, nullable=false)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="province", type="integer", nullable=false)
     */
    private $province;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=false)
     */
    private $birthdate = '1992-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="birthplace", type="string", length=100, nullable=false)
     */
    private $birthplace;

    /**
     * @var integer
     *
     * @ORM\Column(name="nation", type="integer", nullable=false)
     */
    private $nation = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", nullable=false)
     */
    private $sex = 'M';

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=60, nullable=false)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=60, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=60, nullable=false)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=60, nullable=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="websiteurl", type="string", length=80, nullable=false)
     */
    private $websiteurl;

    /**
     * @var string
     *
     * @ORM\Column(name="fiscalcode", type="string", length=80, nullable=false)
     */
    private $fiscalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="vatcode", type="string", length=60, nullable=false)
     */
    private $vatcode;

    /**
     * @var string
     *
     * @ORM\Column(name="newsletter", type="string", length=1, nullable=false)
     */
    private $newsletter = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="newsletter_format", type="string", nullable=false)
     */
    private $newsletterFormat = 'html';

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=80, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=80, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=false)
     */
    private $status = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="admingrant", type="string", length=1, nullable=false)
     */
    private $admingrant = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = '2010-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable=false)
     */
    private $lastupdate = '2010-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="confirmationcode", type="string", length=100, nullable=false)
     */
    private $confirmationcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     */
    private $roleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="integer", nullable=false)
     */
    private $languageId;

    /**
     * Set id
     *
     * @param string $id
     * @return Users
     */
    public function setId($id)
    {
    	$this->id = $id;
    }
    
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
     * Set image
     *
     * @param string $image
     * @return Users
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Users
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
     * @return Users
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
     * @return Users
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
     * Set capzip
     *
     * @param string $capzip
     * @return Users
     */
    public function setCapzip($capzip)
    {
        $this->capzip = $capzip;

        return $this;
    }

    /**
     * Get capzip
     *
     * @return string 
     */
    public function getCapzip()
    {
        return $this->capzip;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Users
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set province
     *
     * @param integer $province
     * @return Users
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return integer 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return Users
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set birthplace
     *
     * @param string $birthplace
     * @return Users
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    /**
     * Get birthplace
     *
     * @return string 
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * Set nation
     *
     * @param integer $nation
     * @return Users
     */
    public function setNation($nation)
    {
        $this->nation = $nation;

        return $this;
    }

    /**
     * Get nation
     *
     * @return integer 
     */
    public function getNation()
    {
        return $this->nation;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Users
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set job
     *
     * @param string $job
     * @return Users
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
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
     * @return Users
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
     * Set mobile
     *
     * @param string $mobile
     * @return Users
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Users
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set websiteurl
     *
     * @param string $websiteurl
     * @return Users
     */
    public function setWebsiteurl($websiteurl)
    {
        $this->websiteurl = $websiteurl;

        return $this;
    }

    /**
     * Get websiteurl
     *
     * @return string 
     */
    public function getWebsiteurl()
    {
        return $this->websiteurl;
    }

    /**
     * Set fiscalcode
     *
     * @param string $fiscalcode
     * @return Users
     */
    public function setFiscalcode($fiscalcode)
    {
        $this->fiscalcode = $fiscalcode;

        return $this;
    }

    /**
     * Get fiscalcode
     *
     * @return string 
     */
    public function getFiscalcode()
    {
        return $this->fiscalcode;
    }

    /**
     * Set vatcode
     *
     * @param string $vatcode
     * @return Users
     */
    public function setVatcode($vatcode)
    {
        $this->vatcode = $vatcode;

        return $this;
    }

    /**
     * Get vatcode
     *
     * @return string 
     */
    public function getVatcode()
    {
        return $this->vatcode;
    }

    /**
     * Set newsletter
     *
     * @param string $newsletter
     * @return Users
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return string 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set newsletterFormat
     *
     * @param string $newsletterFormat
     * @return Users
     */
    public function setNewsletterFormat($newsletterFormat)
    {
        $this->newsletterFormat = $newsletterFormat;

        return $this;
    }

    /**
     * Get newsletterFormat
     *
     * @return string 
     */
    public function getNewsletterFormat()
    {
        return $this->newsletterFormat;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Users
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
     * Set admingrant
     *
     * @param string $admingrant
     * @return Users
     */
    public function setAdmingrant($admingrant)
    {
        $this->admingrant = $admingrant;

        return $this;
    }

    /**
     * Get admingrant
     *
     * @return string 
     */
    public function getAdmingrant()
    {
        return $this->admingrant;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Users
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     * @return Users
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }

    /**
     * Get lastupdate
     *
     * @return \DateTime 
     */
    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    /**
     * Set confirmationcode
     *
     * @param string $confirmationcode
     * @return Users
     */
    public function setConfirmationcode($confirmationcode)
    {
        $this->confirmationcode = $confirmationcode;

        return $this;
    }

    /**
     * Get confirmationcode
     *
     * @return string 
     */
    public function getConfirmationcode()
    {
        return $this->confirmationcode;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     * @return Users
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set languageId
     *
     * @param integer $languageId
     * @return Users
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * Get languageId
     *
     * @return integer 
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }
}
