<?php

namespace AdminTest\Model\Attachments;

use Admin\Model\Attachments\AttachmentsContainer;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  08 March 2014
 */
class AttachmentsContainerTest extends TestSuite
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testAssignFileName()
    {
        $this->assertEquals(
            '1_invaliflenm.pdf',
            AttachmentsContainer::assignFileName('InvaliFìlenàmè.pdf', 1)
        );
    }
}