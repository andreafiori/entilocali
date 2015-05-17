<?php

namespace Admin\Model\Attachments;

use Admin\Model\Attachments\AttachmentsPropertiesGetterAbstract;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ApplicationTest\TestSuite;

class AttachmentsPropertiesGetterAbstractTest extends TestSuite
{
    /**
     * @var AttachmentsPropertiesGetterAbstract
     */
    private $attachmentsPropertiesGetterAbstract;

    protected function setUp()
    {
        parent::setUp();

        $this->attachmentsPropertiesGetterAbstract = $this->getMockForAbstractClass('\Admin\Model\Attachments\AttachmentsPropertiesGetterAbstract');
    }

    public function testSetObjectWrapper()
    {
        $this->attachmentsPropertiesGetterAbstract->setObjectWrapper(
            new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($this->getEntityManagerMock()))
        );

        $this->assertTrue( is_object($this->attachmentsPropertiesGetterAbstract->getObjectWrapper()) );
    }
}