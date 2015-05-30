<?php

namespace ModelModuleTest\Model\Attachments;

use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;
use ModelModule\Model\Attachments\AttachmentsFormControllerHelperAbstract;
use ModelModule\Model\Modules\ModulesGetter;
use ModelModule\Model\Modules\ModulesGetterWrapper;
use ModelModuleTest\TestSuite;

class AttachmentsFormControllerHelperAbstractTest extends TestSuite
{
    /**
     * @var AttachmentsFormControllerHelperAbstract
     */
    private $attachmentsFormControllerHelper;

    protected function setUp()
    {
        parent::setUp();

        $this->attachmentsFormControllerHelper = $this->getMockForAbstractClass(
            '\ModelModule\Model\Attachments\AttachmentsFormControllerHelperAbstract'
        );
    }
    public function testSetModulesGetterWrapper()
    {
        $this->attachmentsFormControllerHelper->setModulesGetterWrapper(
            new ModulesGetterWrapper(new ModulesGetter($this->getEntityManagerMock()))
        );

        $this->assertInstanceOf(
            '\ModelModule\Model\Modules\ModulesGetterWrapper',
            $this->attachmentsFormControllerHelper->getModulesGetterWrapper()
        );
    }

    public function testSetAttachmentsGetterWrapper()
    {
        $this->attachmentsFormControllerHelper->setAttachmentsGetterWrapper(
            new AttachmentsGetterWrapper( new AttachmentsGetter($this->getEntityManagerMock()) )
        );

        $this->assertInstanceOf(
            '\ModelModule\Model\Attachments\AttachmentsGetterWrapper',
            $this->attachmentsFormControllerHelper->getAttachmentsGetterWrapper()
        );
    }

}