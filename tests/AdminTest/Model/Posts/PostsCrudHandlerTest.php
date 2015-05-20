<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\Posts\PostsCrudHandler;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
class PostsCrudHandlerTest //extends CrudHandlerTestSuite
{
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new PostsCrudHandler();

        $this->formSampleData = array(
            'postid'            => '',
            'postoptionid'      => '',
            'title'             => 'Post Title',
            'subtitle'          => 'Post subtititle',
            'description'       => 'Post description [long text]',
            'expireDate'        => '2015-04-12 01:00:00',
            'status'            => 1,
            'seoDescription'    => 'my description for SEOs',
            'seoKeywords'       => 'my,keywwords',
            'category'          => array(1, 2),
            'moduleId'          => 2,
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->postid, 'Post ID must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->postoptionid, 'Postoptionid must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->title, 'Title must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->subtitle, 'Subtitle must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->description, 'Description must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->expireDate, 'ExpireDate must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->status, 'status must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->seoDescription, 'seoDescription must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->seoKeywords, 'seoKeyworkds must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->category, 'Category must not be null');
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->moduleId, 'ModuleId must not be null');
    }
}
