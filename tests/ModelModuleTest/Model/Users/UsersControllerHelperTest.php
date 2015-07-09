<?php

namespace ModelModuleTest\Model\Users;

use ModelModule\Model\Users\UsersControllerHelper;
use ModelModuleTest\TestSuite;

class UsersControllerHelperTest extends TestSuite
{
    /**
     * @var UsersControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new UsersControllerHelper();
    }

    public function testfFormatUsersForDropdown()
    {
        $this->helper->formatUsersForDropdown(array(), 'id');
    }

    public function testGenerateSalt()
    {
        $this->assertTrue( is_string($this->helper->generateSalt()) );
    }

    /**
     * @expectedException \Exception
     */
    public function testVerifyPasswordThrowsException()
    {
        $this->helper->verifyPassword('mypass1','mypass2', 'My error message');
    }
}
