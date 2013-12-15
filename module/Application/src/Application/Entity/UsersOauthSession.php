<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersOauthSession
 *
 * @ORM\Table(name="users_oauth_session", uniqueConstraints={@ORM\UniqueConstraint(name="social_oauth_session_index", columns={"session", "server"})})
 * @ORM\Entity
 */
class UsersOauthSession
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
     * @ORM\Column(name="session", type="string", length=32, nullable=false)
     */
    private $session = '';

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=32, nullable=false)
     */
    private $state = '';

    /**
     * @var string
     *
     * @ORM\Column(name="access_token", type="text", nullable=false)
     */
    private $accessToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiry", type="datetime", nullable=true)
     */
    private $expiry;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=12, nullable=false)
     */
    private $type = '';

    /**
     * @var string
     *
     * @ORM\Column(name="server", type="string", length=12, nullable=false)
     */
    private $server = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation", type="datetime", nullable=false)
     */
    private $creation = '2000-01-01 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="access_token_secret", type="text", nullable=false)
     */
    private $accessTokenSecret;

    /**
     * @var string
     *
     * @ORM\Column(name="authorized", type="string", length=1, nullable=true)
     */
    private $authorized;

    /**
     * @var integer
     *
     * @ORM\Column(name="user", type="integer", nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="refresh_token", type="text", nullable=false)
     */
    private $refreshToken;



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
     * Set session
     *
     * @param string $session
     * @return UsersOauthSession
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return string 
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return UsersOauthSession
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set accessToken
     *
     * @param string $accessToken
     * @return UsersOauthSession
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string 
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set expiry
     *
     * @param \DateTime $expiry
     * @return UsersOauthSession
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;

        return $this;
    }

    /**
     * Get expiry
     *
     * @return \DateTime 
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return UsersOauthSession
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set server
     *
     * @param string $server
     * @return UsersOauthSession
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return string 
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set creation
     *
     * @param \DateTime $creation
     * @return UsersOauthSession
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;

        return $this;
    }

    /**
     * Get creation
     *
     * @return \DateTime 
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * Set accessTokenSecret
     *
     * @param string $accessTokenSecret
     * @return UsersOauthSession
     */
    public function setAccessTokenSecret($accessTokenSecret)
    {
        $this->accessTokenSecret = $accessTokenSecret;

        return $this;
    }

    /**
     * Get accessTokenSecret
     *
     * @return string 
     */
    public function getAccessTokenSecret()
    {
        return $this->accessTokenSecret;
    }

    /**
     * Set authorized
     *
     * @param string $authorized
     * @return UsersOauthSession
     */
    public function setAuthorized($authorized)
    {
        $this->authorized = $authorized;

        return $this;
    }

    /**
     * Get authorized
     *
     * @return string 
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }

    /**
     * Set user
     *
     * @param integer $user
     * @return UsersOauthSession
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     * @return UsersOauthSession
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string 
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }
}
