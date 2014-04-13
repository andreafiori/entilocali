<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsRelazioni
 *
 * @ORM\Table(name="posts_relazioni", indexes={@ORM\Index(name="posts_id", columns={"posts_id"}), @ORM\Index(name="canale_id", columns={"canale_id"}), @ORM\Index(name="modulo_id", columns={"modulo_id"}), @ORM\Index(name="categoria_id", columns={"categoria_id"})})
 * @ORM\Entity
 */
class PostsRelazioni
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
     * @var \Application\Entity\Posts
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="posts_id", referencedColumnName="id")
     * })
     */
    private $posts;

    /**
     * @var \Application\Entity\Categorie
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \Application\Entity\Canali
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Canali")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="canale_id", referencedColumnName="id")
     * })
     */
    private $canale;

    /**
     * @var \Application\Entity\Moduli
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Moduli")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modulo_id", referencedColumnName="id")
     * })
     */
    private $modulo;



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
     * Set posts
     *
     * @param \Application\Entity\Posts $posts
     * @return PostsRelazioni
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

    /**
     * Set categoria
     *
     * @param \Application\Entity\Categorie $categoria
     * @return PostsRelazioni
     */
    public function setCategoria(\Application\Entity\Categorie $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Application\Entity\Categorie 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set canale
     *
     * @param \Application\Entity\Canali $canale
     * @return PostsRelazioni
     */
    public function setCanale(\Application\Entity\Canali $canale = null)
    {
        $this->canale = $canale;

        return $this;
    }

    /**
     * Get canale
     *
     * @return \Application\Entity\Canali 
     */
    public function getCanale()
    {
        return $this->canale;
    }

    /**
     * Set modulo
     *
     * @param \Application\Entity\Moduli $modulo
     * @return PostsRelazioni
     */
    public function setModulo(\Application\Entity\Moduli $modulo = null)
    {
        $this->modulo = $modulo;

        return $this;
    }

    /**
     * Get modulo
     *
     * @return \Application\Entity\Moduli 
     */
    public function getModulo()
    {
        return $this->modulo;
    }
}
