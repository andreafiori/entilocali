<?php

namespace AdminTest\Model\Attachments;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\Attachments\AttachmentsCrudHandler;

/**
 * @author Andrea Fiori
 * @since  24 March 2015
 */
class AttachmentsCrudHandlerTest //extends CrudHandlerTestSuite
{
    /**
     * @var AttachmentsCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new AttachmentsCrudHandler();
        $this->crudHandler->setConfigurationsFromDb(array(
            'sitename'            => 'My website name',
            'seo_title'           => 'My SEO title test',
            'amazon_s3_accesskey' => 'MyS3AccessKey',
            'amazon_s3_secretkey' => 'MyVerySecretS3Key'
        ));

        $this->formSampleData = array(
            'id'             => '',
            'attachmentFile' => array(
                'name' => 'Myfile.txt',
                'size' => '12321',
                'type' => 'text/plain',
                'tmp_name' => 'mytmpfilename.txt',
            ),
            'title'          => 'This is my attachment file test',
            'description'    => 'Attachment file description',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->attachmentFile);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->title);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->description);
    }
}