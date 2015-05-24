<?php

namespace AdminTest\Model;

use Admin\Model\HomePage\HomePageBlocksGetter;
use Admin\Model\HomePage\HomePageBlocksGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use ApplicationTest\TestSuite;

class ControllerHelperAbstractTest extends TestSuite
{
    /**
     * @var \Admin\Model\ControllerHelperAbstract
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = $this->getMockForAbstractClass('\Admin\Model\ControllerHelperAbstract');
    }

    public function testSetUsersGetterWrapper()
    {
        $this->helper->setUsersGetterWrapper(new UsersGetterWrapper(
                new UsersGetter($this->getEntityManagerMock()))
        );

        $this->assertInstanceOf(
            '\Admin\Model\Users\UsersGetterWrapper',
            $this->helper->getUsersGetterWrapper()
        );
    }

    public function testSetupUsersGetterWrapperRecords()
    {
        $this->helper->setUsersGetterWrapper(new UsersGetterWrapper(
                new UsersGetter($this->getEntityManagerMock()))
        );

        $this->helper->setupUsersGetterWrapperRecords();

        $this->assertTrue( is_array($this->helper->getUsersGetterWrapperRecords()) );
    }

    public function testSetHomePageBlocksGetterWrapper()
    {
        $this->helper->setHomePageBlocksGetterWrapper(
            new HomePageBlocksGetterWrapper(new HomePageBlocksGetter($this->getEntityManagerMock()))
        );

        $this->assertInstanceOf(
            '\Admin\Model\HomePage\HomePageBlocksGetterWrapper',
            $this->helper->getHomePageBlocksGetterWrapper()
        );
    }

    public function testSetupHomePageBlocksRecords()
    {
        $this->helper->setHomePageBlocksGetterWrapper(
            new HomePageBlocksGetterWrapper(new HomePageBlocksGetter($this->getEntityManagerMock()))
        );

        $this->helper->setupHomePageBlocksRecords();

        $this->assertTrue( is_array($this->helper->getHomePageBlocksRecords()) );
    }

    /**
     * @expectedException \Exception
     */
    public function testCheckHomePageBlocksRecords()
    {
        $this->helper->checkHomePageBlocksRecords();
    }
}
