<?php

namespace ModelModuleTest\Model;

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

    /**
     * @expectedException \Exception
     */
    public function testCheckRecordsetThrowsException()
    {
        $this->helper->checkRecordset(array());
    }
}
