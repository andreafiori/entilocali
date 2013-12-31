<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsRelations
 *
 * @ORM\Table(name="posts_relations", indexes={@ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="posts_id", columns={"posts_id"}), @ORM\Index(name="channel_id", columns={"channel_id"})})
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
     * @var \Application\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

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
     * @var \Application\Entity\Modules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;

    /**
     * @var \Application\Entity\Posts
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Posts")
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
     * @param \Application\Entity\Categories $category
     * @return PostsRelations
     */
    public function setCategory(\Application\Entity\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Application\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
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
     * Set module
     *
     * @param \Application\Entity\Modules $module
     * @return PostsRelations
     */
    public function setModule(\Application\Entity\Modules $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\Modules 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set posts
     *
     * @param \Application\Entity\Posts $posts
     * @return PostsRelations
     */
    public function setPosts(\Application\Entity\Posts $posts = null)
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * Get posts
     *
     * @return \Application\Entity\Posts 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
