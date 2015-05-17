<?php

namespace AdminTest\Model\Attachments;

use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
use Admin\Model\Attachments\AttachmentsFormControllerHelperAbstract;
use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;
use ApplicationTest\TestSuite;

class AttachmentsFormControllerHelperAbstractTest extends TestSuite
{
    /**
     * @var AttachmentsFormControllerHelperAbstract
     */
    private $attachmentsFormControllerHelper;

    protected function setUp()
    {
        parent::setUp();

        $this->attachmentsFormControllerHelper = $this->getMockForAbstractClass('\Admin\Model\Attachments\AttachmentsFormControllerHelperAbstract');
    }
    public function testSetModulesGetterWrapper()
    {
        $this->attachmentsFormControllerHelper->setModulesGetterWrapper(
            new ModulesGetterWrapper(new ModulesGetter($this->getEntityManagerMock()))
        );

        $this->assertInstanceOf(
            '\Admin\Model\Modules\ModulesGetterWrapper',
            $this->attachmentsFormControllerHelper->getModulesGetterWrapper()
        );
    }

    public function testSetAttachmentsGetterWrapper()
    {
        $this->attachmentsFormControllerHelper->setAttachmentsGetterWrapper(
            new AttachmentsGetterWrapper( new AttachmentsGetter($this->getEntityManagerMock()) )
        );

        $this->assertInstanceOf(
            '\Admin\Model\Attachments\AttachmentsGetterWrapper',
            $this->attachmentsFormControllerHelper->getAttachmentsGetterWrapper()
        );
    }

}