<?php

namespace ModelModuleTest\Model\Attachments;

use ModelModule\Model\Attachments\AttachmentsCrudHandlerHelper;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\Attachments\AttachmentsMimetypeGetter;
use ModelModule\Model\Attachments\AttachmentsMimetypeGetterWrapper;
use ModelModuleTest\TestSuite;

class AttachmentsCrudHandlerHelperTest extends TestSuite
{
    /**
     * @var AttachmentsCrudHandlerHelper
     */
    private $attachmentsCrudHandlerHelper;

    protected function setUp()
    {
        parent::setUp();

        $this->attachmentsCrudHandlerHelper = new AttachmentsCrudHandlerHelper();
    }

    public function testSetAttachmentsMimeTypeGetterWrapper()
    {
        $this->attachmentsCrudHandlerHelper->setAttachmentsMimeTypeGetterWrapper(new AttachmentsMimetypeGetterWrapper(
                new AttachmentsMimetypeGetter($this->getEntityManagerMock())
            )
        );

        $this->assertInstanceOf('\ModelModule\Model\Attachments\AttachmentsMimetypeGetterWrapper', $this->attachmentsCrudHandlerHelper->getAttachmentsMimeTypeGetterWrapper());
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testRecoverMimeTypeRecodsThrowsException()
    {
        $this->attachmentsCrudHandlerHelper->recoverMimeTypeRecods();
    }

    public function testRecoverMimeTypeRecods()
    {
        $this->attachmentsCrudHandlerHelper->setAttachmentsMimeTypeGetterWrapper(new AttachmentsMimetypeGetterWrapper(
                new AttachmentsMimetypeGetter($this->getEntityManagerMock())
            )
        );

        $this->assertTrue( is_array($this->attachmentsCrudHandlerHelper->recoverMimeTypeRecods(array())));
    }
}