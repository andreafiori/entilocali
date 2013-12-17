<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relations
 *
 * @ORM\Table(name="relations", indexes={@ORM\Index(name="relations_ids", columns={"relation_category", "relation_id", "channel_id", "language_id", "module_id", "relation_attachment"}), @ORM\Index(name="IDX_146CBF7882F1BAF4", columns={"language_id"})})
 * @ORM\Entity
 */
class Relations
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
     * @ORM\Column(name="relation_category", type="integer", nullable=false)
     */
    private $relationCategory = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="relation_id", type="integer", nullable=false)
     */
    private $relationId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="relation_attachment", type="integer", nullable=false)
     */
    private $relationAttachment = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
     */
    private $moduleId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
     */
    private $channelId = '1';

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
     * Set relationCategory
     *
     * @param integer $relationCategory
     * @return Relations
     */
    public function setRelationCategory($relationCategory)
    {
        $this->relationCategory = $relationCategory;

        return $this;
    }

    /**
     * Get relationCategory
     *
     * @return integer 
     */
    public function getRelationCategory()
    {
        return $this->relationCategory;
    }

    /**
     * Set relationId
     *
     * @param integer $relationId
     * @return Relations
     */
    public function setRelationId($relationId)
    {
        $this->relationId = $relationId;

        return $this;
    }

    /**
     * Get relationId
     *
     * @return integer 
     */
    public function getRelationId()
    {
        return $this->relationId;
    }

    /**
     * Set relationAttachment
     *
     * @param integer $relationAttachment
     * @return Relations
     */
    public function setRelationAttachment($relationAttachment)
    {
        $this->relationAttachment = $relationAttachment;

        return $this;
    }

    /**
     * Get relationAttachment
     *
     * @return integer 
     */
    public function getRelationAttachment()
    {
        return $this->relationAttachment;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     * @return Relations
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
     * Set channelId
     *
     * @param integer $channelId
     * @return Relations
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Get channelId
     *
     * @return integer 
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set language
     *
     * @param \Application\Entity\Languages $language
     * @return Relations
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
