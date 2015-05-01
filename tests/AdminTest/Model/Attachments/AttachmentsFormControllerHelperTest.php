<?php

namespace AdminTest\Model\Attachments;

use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;
use Admin\Model\Attachments\AttachmentsFormControllerHelper;
use ApplicationTest\TestSuite;

class AttachmentsFormControllerHelperTest extends TestSuite
{
    /**
     * @var AttachmentsFormControllerHelper
     */
    private $attachmentsFormControllerHelper;

    protected function setUp()
    {
        parent::setUp();

        $this->attachmentsFormControllerHelper = new AttachmentsFormControllerHelper();
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

    public function testSetupModuleRecords()
    {
        $this->attachmentsFormControllerHelper->setModulesGetterWrapper(
            new ModulesGetterWrapper(new ModulesGetter($this->getEntityManagerMock()))
        );
        $this->attachmentsFormControllerHelper->setupModuleRecords('albo-pretorio');

        $this->assertTrue(is_array($this->attachmentsFormControllerHelper->getModuleRecords()));
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetupModuleRecordsThrowsException()
    {
        $this->attachmentsFormControllerHelper->setupModuleRecords('albo-pretorio');
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testCheckModuleRecordsThrowsException()
    {
        $this->attachmentsFormControllerHelper->checkModuleRecords();
    }
}