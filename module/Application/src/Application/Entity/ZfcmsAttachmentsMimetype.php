<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAttachmentsMimetype
 *
 * @ORM\Table(name="zfcms_attachments_mimetype")
 * @ORM\Entity
 */
class ZfcmsAttachmentsMimetype
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
     * @ORM\Column(name="image", type="text", length=65535, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="mimetype", type="text", length=65535, nullable=false)
     */
    private $mimetype;



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
     * @return ZfcmsAttachmentsMimetype
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
     * Set mimetype.
    
     *
     * @param string $mimetype
     *
     * @return ZfcmsAttachmentsMimetype
     */
    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;
    
        return $this;
    }

    /**
     * Get mimetype.
    
     *
     * @return string
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }
}
