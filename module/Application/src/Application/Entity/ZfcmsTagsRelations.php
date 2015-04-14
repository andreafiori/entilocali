<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsTagsRelations
 *
 * @ORM\Table(name="zfcms_tags_relations", indexes={@ORM\Index(name="fk_tags_relations", columns={"tag_id"}), @ORM\Index(name="fk_tags_module", columns={"module_id"})})
 * @ORM\Entity
 */
class ZfcmsTagsRelations
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
     * @ORM\Column(name="reference_id", type="bigint", nullable=false)
     */
    private $referenceId;

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
     * @var \Application\Entity\ZfcmsTags
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsTags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     * })
     */
    private $tag;



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
     * Set referenceId
     *
     * @param integer $referenceId
     * @return ZfcmsTagsRelations
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
     * Set module
     *
     * @param \Application\Entity\ZfcmsModules $module
     * @return ZfcmsTagsRelations
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
     * Set tag
     *
     * @param \Application\Entity\ZfcmsTags $tag
     * @return ZfcmsTagsRelations
     */
    public function setTag(\Application\Entity\ZfcmsTags $tag = null)
    {
        $this->tag = $tag;
    
        return $this;
    }

    /**
     * Get tag
     *
     * @return \Application\Entity\ZfcmsTags 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
