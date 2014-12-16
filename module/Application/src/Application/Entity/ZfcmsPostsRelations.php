<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsPostsRelations
 *
 * @ORM\Table(name="zfcms_posts_relations", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="posts_id", columns={"posts_id"})})
 * @ORM\Entity
 */
class ZfcmsPostsRelations
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
     * @var \Application\Entity\ZfcmsCategories
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Application\Entity\ZfcmsChannels
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsChannels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     * })
     */
    private $channel;

    /**
     * @var \Application\Entity\ZfcmsModules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;

    /**
     * @var \Application\Entity\ZfcmsPosts
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsPosts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="posts_id", referencedColumnName="id")
     * })
     */
    private $posts;



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
     * Set category
     *
     * @param \Application\Entity\ZfcmsCategories $category
     *
     * @return ZfcmsPostsRelations
     */
    public function setCategory(\Application\Entity\ZfcmsCategories $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Application\Entity\ZfcmsCategories
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set channel
     *
     * @param \Application\Entity\ZfcmsChannels $channel
     *
     * @return ZfcmsPostsRelations
     */
    public function setChannel(\Application\Entity\ZfcmsChannels $channel = null)
    {
        $this->channel = $channel;
    
        return $this;
    }

    /**
     * Get channel
     *
     * @return \Application\Entity\ZfcmsChannels
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set module
     *
     * @param \Application\Entity\ZfcmsModules $module
     *
     * @return ZfcmsPostsRelations
     */
    public function setModule(\Application\Entity\ZfcmsModules $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\ZfcmsModules
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set posts
     *
     * @param \Application\Entity\ZfcmsPosts $posts
     *
     * @return ZfcmsPostsRelations
     */
    public function setPosts(\Application\Entity\ZfcmsPosts $posts = null)
    {
        $this->posts = $posts;
    
        return $this;
    }

    /**
     * Get posts
     *
     * @return \Application\Entity\ZfcmsPosts
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
