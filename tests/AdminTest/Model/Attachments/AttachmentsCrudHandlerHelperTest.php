<?php

namespace AdminTest\Model\Attachments;

use Admin\Model\Attachments\AttachmentsCrudHandlerHelper;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
use Admin\Model\Attachments\AttachmentsMimetypeGetter;
use Admin\Model\Attachments\AttachmentsMimetypeGetterWrapper;
use ApplicationTest\TestSuite;

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

        $this->assertInstanceOf('\Admin\Model\Attachments\AttachmentsMimetypeGetterWrapper', $this->attachmentsCrudHandlerHelper->getAttachmentsMimeTypeGetterWrapper());
    }

    /**
     * @expectedException \Application\Model\NullException
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