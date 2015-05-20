<?php

namespace AdminTest\Model\Attachments;

use Admin\Model\Attachments\AttachmentsForm;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;
use Admin\Model\Attachments\AttachmentsFormControllerHelper;
use ApplicationTest\TestSuite;

class AttachmentsFormControllerHelperTest extends TestSuite
{
    /**
     * @var AttachmentsFormControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new AttachmentsFormControllerHelper();
    }

    public function testSetupModuleRecords()
    {
        $this->helper->setModulesGetterWrapper(
            new ModulesGetterWrapper(new ModulesGetter($this->getEntityManagerMock()))
        );
        $this->helper->setupModuleRecords('albo-pretorio');

        $this->assertTrue(is_array($this->helper->getModuleRecords()));
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetupModuleRecordsThrowsException()
    {
        $this->helper->setupModuleRecords('albo-pretorio');
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testCheckModuleRecordsThrowsException()
    {
        $this->helper->checkModuleRecords();
    }

    public function testSetupAttachmentsRecords()
    {
        $this->helper->setAttachmentsGetterWrapper(
            new AttachmentsGetterWrapper( new AttachmentsGetter($this->getEntityManagerMock()) )
        );
        $this->helper->setupAttachmentsRecords();

        $this->assertTrue( is_array($this->helper->getAttachmentRecords()) );
    }

    /**
     * @expectedException \Exception
     */
    public function testSetupAttachmentsRecordsThrowsException()
    {
        $this->helper->setupAttachmentsRecords();
    }

    /**
     * @expectedException \Exception
     */
    public function testCheckModuleCodeThrowsException()
    {
        $this->helper->setModuleCode('non-existing-module');

        $this->helper->checkModuleRecords();
    }

    public function testSetAttachmentsForm()
    {
        $this->helper->setAttachmentsForm(new AttachmentsForm());

        $this->assertInstanceOf(
            '\Admin\Model\Attachments\AttachmentsForm',
            $this->helper->getAttachmentsForm()
        );
    }

    public function testBuildForm()
    {
        $this->helper->setAttachmentsForm(new AttachmentsForm());

        $this->helper->buildForm(array());

        $this->assertInstanceOf(
            '\Admin\Model\Attachments\AttachmentsForm',
            $this->helper->getAttachmentsForm()
        );
    }
}