<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersBookmarks
 *
 * @ORM\Table(name="users_bookmarks", indexes={@ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="reference_id", columns={"reference_id"})})
 * @ORM\Entity
 */
class UsersBookmarks
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
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="reference_id", type="bigint", nullable=false)
     */
    private $referenceId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="bigint", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="bigint", nullable=false)
     */
    private $moduleId = '0';



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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UsersBookmarks
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set referenceId
     *
     * @param integer $referenceId
     *
     * @return UsersBookmarks
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    
        return $this;
    }

    /**
     * Get referenceId
     *
     * @return integer
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return UsersBookmarks
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    
        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     *
     * @return UsersBookmarks
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;
    
        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }
}
