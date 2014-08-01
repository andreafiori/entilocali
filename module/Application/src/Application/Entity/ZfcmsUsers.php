<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsers
 *
 * @ORM\Table(name="zfcms_users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="key_ids", columns={"role_id", "nation", "province"}), @ORM\Index(name="IDX_770AE5C7D60322AC", columns={"role_id"})})
 * @ORM\Entity
 */
class ZfcmsUsers
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
     * @ORM\Column(name="zip", type="string", length=5, nullable=false)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=60, nullable=false)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="province", type="bigint", nullable=false)
     */
    private $province;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="datetime", nullable=false)
     */
    private $birthDate = '1992-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="birth_place", type="string", length=100, nullable=false)
     */
    private $birthPlace;

    /**
     * @var integer
     *
     * @ORM\Column(name="nation", type="bigint", nullable=false)
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
     * @ORM\Column(name="website_url", type="string", length=80, nullable=false)
     */
    private $websiteUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="fiscal_code", type="string", length=80, nullable=false)
     */
    private $fiscalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="vat_code", type="string", length=60, nullable=false)
     */
    private $vatCode;

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
     * @var \DateTime
     *
     * @ORM\Column(name="password_last_update", type="datetime", nullable=false)
     */
    private $passwordLastUpdate = '2014-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=false)
     */
    private $status = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="settore", type="string", length=100, nullable=false)
     */
    private $settore = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate = '2014-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false)
     */
    private $lastUpdate = '2014-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="confirm_code", type="string", length=100, nullable=false)
     */
    private $confirmCode;

    /**
     * @var \Application\Entity\ZfcmsUsersRoles
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsersRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;



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
     * Set image.
    
     *
     * @param string $image
     *
     * @return ZfcmsUsers
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image.
    
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set name.
    
     *
     * @param string $name
     *
     * @return ZfcmsUsers
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name.
    
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname.
    
     *
     * @param string $surname
     *
     * @return ZfcmsUsers
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
        return $this;
    }

    /**
     * Get surname.
    
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set address.
    
     *
     * @param string $address
     *
     * @return ZfcmsUsers
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address.
    
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip.
    
     *
     * @param string $zip
     *
     * @return ZfcmsUsers
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    
        return $this;
    }

    /**
     * Get zip.
    
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city.
    
     *
     * @param string $city
     *
     * @return ZfcmsUsers
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city.
    
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set province.
    
     *
     * @param integer $province
     *
     * @return ZfcmsUsers
     */
    public function setProvince($province)
    {
        $this->province = $province;
    
        return $this;
    }

    /**
     * Get province.
    
     *
     * @return integer
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set birthDate.
    
     *
     * @param \DateTime $birthDate
     *
     * @return ZfcmsUsers
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    
        return $this;
    }

    /**
     * Get birthDate.
    
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set birthPlace.
    
     *
     * @param string $birthPlace
     *
     * @return ZfcmsUsers
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
    
        return $this;
    }

    /**
     * Get birthPlace.
    
     *
     * @return string
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set nation.
    
     *
     * @param integer $nation
     *
     * @return ZfcmsUsers
     */
    public function setNation($nation)
    {
        $this->nation = $nation;
    
        return $this;
    }

    /**
     * Get nation.
    
     *
     * @return integer
     */
    public function getNation()
    {
        return $this->nation;
    }

    /**
     * Set sex.
    
     *
     * @param string $sex
     *
     * @return ZfcmsUsers
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex.
    
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set job.
    
     *
     * @param string $job
     *
     * @return ZfcmsUsers
     */
    public function setJob($job)
    {
        $this->job = $job;
    
        return $this;
    }

    /**
     * Get job.
    
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set email.
    
     *
     * @param string $email
     *
     * @return ZfcmsUsers
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email.
    
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone.
    
     *
     * @param string $phone
     *
     * @return ZfcmsUsers
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone.
    
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobile.
    
     *
     * @param string $mobile
     *
     * @return ZfcmsUsers
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile.
    
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set fax.
    
     *
     * @param string $fax
     *
     * @return ZfcmsUsers
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax.
    
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set websiteUrl.
    
     *
     * @param string $websiteUrl
     *
     * @return ZfcmsUsers
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;
    
        return $this;
    }

    /**
     * Get websiteUrl.
    
     *
     * @return string
     */
    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    /**
     * Set fiscalCode.
    
     *
     * @param string $fiscalCode
     *
     * @return ZfcmsUsers
     */
    public function setFiscalCode($fiscalCode)
    {
        $this->fiscalCode = $fiscalCode;
    
        return $this;
    }

    /**
     * Get fiscalCode.
    
     *
     * @return string
     */
    public function getFiscalCode()
    {
        return $this->fiscalCode;
    }

    /**
     * Set vatCode.
    
     *
     * @param string $vatCode
     *
     * @return ZfcmsUsers
     */
    public function setVatCode($vatCode)
    {
        $this->vatCode = $vatCode;
    
        return $this;
    }

    /**
     * Get vatCode.
    
     *
     * @return string
     */
    public function getVatCode()
    {
        return $this->vatCode;
    }

    /**
     * Set newsletter.
    
     *
     * @param string $newsletter
     *
     * @return ZfcmsUsers
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    
        return $this;
    }

    /**
     * Get newsletter.
    
     *
     * @return string
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set newsletterFormat.
    
     *
     * @param string $newsletterFormat
     *
     * @return ZfcmsUsers
     */
    public function setNewsletterFormat($newsletterFormat)
    {
        $this->newsletterFormat = $newsletterFormat;
    
        return $this;
    }

    /**
     * Get newsletterFormat.
    
     *
     * @return string
     */
    public function getNewsletterFormat()
    {
        return $this->newsletterFormat;
    }

    /**
     * Set username.
    
     *
     * @param string $username
     *
     * @return ZfcmsUsers
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username.
    
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
    
     *
     * @param string $password
     *
     * @return ZfcmsUsers
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password.
    
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set passwordLastUpdate.
    
     *
     * @param \DateTime $passwordLastUpdate
     *
     * @return ZfcmsUsers
     */
    public function setPasswordLastUpdate($passwordLastUpdate)
    {
        $this->passwordLastUpdate = $passwordLastUpdate;
    
        return $this;
    }

    /**
     * Get passwordLastUpdate.
    
     *
     * @return \DateTime
     */
    public function getPasswordLastUpdate()
    {
        return $this->passwordLastUpdate;
    }

    /**
     * Set status.
    
     *
     * @param string $status
     *
     * @return ZfcmsUsers
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status.
    
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set settore.
    
     *
     * @param string $settore
     *
     * @return ZfcmsUsers
     */
    public function setSettore($settore)
    {
        $this->settore = $settore;
    
        return $this;
    }

    /**
     * Get settore.
    
     *
     * @return string
     */
    public function getSettore()
    {
        return $this->settore;
    }

    /**
     * Set createDate.
    
     *
     * @param \DateTime $createDate
     *
     * @return ZfcmsUsers
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate.
    
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set lastUpdate.
    
     *
     * @param \DateTime $lastUpdate
     *
     * @return ZfcmsUsers
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate.
    
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set confirmCode.
    
     *
     * @param string $confirmCode
     *
     * @return ZfcmsUsers
     */
    public function setConfirmCode($confirmCode)
    {
        $this->confirmCode = $confirmCode;
    
        return $this;
    }

    /**
     * Get confirmCode.
    
     *
     * @return string
     */
    public function getConfirmCode()
    {
        return $this->confirmCode;
    }

    /**
     * Set role.
    
     *
     * @param \Application\Entity\ZfcmsUsersRoles $role
     *
     * @return ZfcmsUsers
     */
    public function setRole(\Application\Entity\ZfcmsUsersRoles $role = null)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role.
    
     *
     * @return \Application\Entity\ZfcmsUsersRoles
     */
    public function getRole()
    {
        return $this->role;
    }
}
