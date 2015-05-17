<?php

namespace AdminTest\Model\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioAttachmentsPropertiesGetter;
use ApplicationTest\TestSuite;

class AlboPretorioAttachmentsPropertiesGetterTest extends TestSuite
{
    /**
     * @var AlboPretorioAttachmentsPropertiesGetter
     */
    private $alboPretorioAttachmentsPropertiesGetter;

    protected function setUp()
    {
        parent::setUp();

        $this->alboPretorioAttachmentsPropertiesGetter = new AlboPretorioAttachmentsPropertiesGetter();
    }

    public function testSetupProperties()
    {
        $this->alboPretorioAttachmentsPropertiesGetter->setEntityManager($this->getEntityManagerMock());

        $this->alboPretorioAttachmentsPropertiesGetter->setupProperties();

        $this->assertNotEmpty($this->alboPretorioAttachmentsPropertiesGetter->getAttachmentsRelatedRecords());
        $this->assertNotEmpty($this->alboPretorioAttachmentsPropertiesGetter->getBreadcrumbModule());
        $this->assertNotEmpty($this->alboPretorioAttachmentsPropertiesGetter->getBreadcrumbRoute());
    }
}