<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersBookmarks
 *
 * @ORM\Table(name="users_bookmarks")
 * @ORM\Entity
 */
class UsersBookmarks
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="bookmark_id", type="integer", nullable=false)
     */
    private $bookmarkId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
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
     * Set bookmarkId
     *
     * @param integer $bookmarkId
     * @return UsersBookmarks
     */
    public function setBookmarkId($bookmarkId)
    {
        $this->bookmarkId = $bookmarkId;

        return $this;
    }

    /**
     * Get bookmarkId
     *
     * @return integer 
     */
    public function getBookmarkId()
    {
        return $this->bookmarkId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
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
