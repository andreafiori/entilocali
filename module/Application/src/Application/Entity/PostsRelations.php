<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsRelations
 *
 * @ORM\Table(name="posts_relations", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="attachment_id", columns={"attachment_id"})})
 * @ORM\Entity
 */
class PostsRelations
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
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="posts_id", type="integer", nullable=false)
     */
    private $postsId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
     */
    private $moduleId = '0';

    /**
     * @var \Application\Entity\Attachments
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Attachments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attachment_id", referencedColumnName="id")
     * })
     */
    private $attachment;

    /**
     * @var \Application\Entity\Channels
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Channels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     * })
     */
    private $channel;

    /**
     * @var \Application\Entity\Languages
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;



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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return PostsRelations
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
     * Set postsId
     *
     * @param integer $postsId
     * @return PostsRelations
     */
    public function setPostsId($postsId)
    {
        $this->postsId = $postsId;

        return $this;
    }

    /**
     * Get postsId
     *
     * @return integer 
     */
    public function getPostsId()
    {
        return $this->postsId;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     * @return PostsRelations
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

    /**
     * Set attachment
     *
     * @param \Application\Entity\Attachments $attachment
     * @return PostsRelations
     */
    public function setAttachment(\Application\Entity\Attachments $attachment = null)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get attachment
     *
     * @return \Application\Entity\Attachments 
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set channel
     *
     * @param \Application\Entity\Channels $channel
     * @return PostsRelations
     */
    public function setChannel(\Application\Entity\Channels $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \Application\Entity\Channels 
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\Languages $language
     * @return PostsRelations
     */
    public function setLanguage(\Application\Entity\Languages $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Application\Entity\Languages 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
