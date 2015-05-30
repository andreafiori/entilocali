<?php

namespace ModelModuleTest\Model;

use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use ModelModuleTest\TestSuite;

class ControllerHelperAbstractTest extends TestSuite
{
    /**
     * @var \ModelModule\Model\ControllerHelperAbstract
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = $this->getMockForAbstractClass('\ModelModule\Model\ControllerHelperAbstract');
    }

    public function testSetUsersGetterWrapper()
    {
        $this->helper->setUsersGetterWrapper(new UsersGetterWrapper(
                new UsersGetter($this->getEntityManagerMock()))
        );

        $this->assertInstanceOf(
            '\ModelModule\Model\Users\UsersGetterWrapper',
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
            '\ModelModule\Model\HomePage\HomePageBlocksGetterWrapper',
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
