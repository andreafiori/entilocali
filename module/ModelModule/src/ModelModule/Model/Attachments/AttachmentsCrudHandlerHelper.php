<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\NullException;

/**
 * Class AttachmentsCrudHandlerHelper
 * @package Admin\Model\Attachments
 */
class AttachmentsCrudHandlerHelper
{
    /**
     * @var AttachmentsMimetypeGetterWrapper
     */
    private $attachmentsMimeTypeGetterWrapper;

    /**
     * @param AttachmentsMimetypeGetterWrapper $wrapper
     * @return AttachmentsMimetypeGetterWrapper
     */
    public function setAttachmentsMimeTypeGetterWrapper(AttachmentsMimetypeGetterWrapper $wrapper)
    {
        $this->attachmentsMimeTypeGetterWrapper = $wrapper;

        return $this->attachmentsMimeTypeGetterWrapper;
    }

    /**
     * @return AttachmentsMimetypeGetterWrapper
     */
    public function getAttachmentsMimeTypeGetterWrapper()
    {
        return $this->attachmentsMimeTypeGetterWrapper;
    }

    private function assertAttachmentsMimeTypeGetterWrapper()
    {
        if(!$this->getAttachmentsMimeTypeGetterWrapper()) {
            throw new NullException("AttachmentsMimeTypeGetterWrapper instance is not set");
        }
    }

    /**
     * @param array $input
     */
    public function recoverMimeTypeRecods($input = array())
    {
        $this->assertAttachmentsMimeTypeGetterWrapper();

        $this->attachmentsMimeTypeGetterWrapper->setInput($input);
        $this->attachmentsMimeTypeGetterWrapper->setupQueryBuilder();

        return $this->attachmentsMimeTypeGetterWrapper->getRecords();
    }
}