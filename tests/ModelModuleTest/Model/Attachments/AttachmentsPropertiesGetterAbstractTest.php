<?php

namespace Admin\Model\Attachments;

use ModelModule\Model\Attachments\AttachmentsPropertiesGetterAbstract;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModuleTest\TestSuite;

class AttachmentsPropertiesGetterAbstractTest extends TestSuite
{
    /**
     * @var AttachmentsPropertiesGetterAbstract
     */
    private $attachmentsPropertiesGetterAbstract;

    protected function setUp()
    {
        parent::setUp();

        $this->attachmentsPropertiesGetterAbstract = $this->getMockForAbstractClass('\ModelModule\Model\Attachments\AttachmentsPropertiesGetterAbstract');
    }

    public function testSetObjectWrapper()
    {
        $this->attachmentsPropertiesGetterAbstract->setObjectWrapper(
            new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($this->getEntityManagerMock()))
        );

        $this->assertTrue( is_object($this->attachmentsPropertiesGetterAbstract->getObjectWrapper()) );
    }
}