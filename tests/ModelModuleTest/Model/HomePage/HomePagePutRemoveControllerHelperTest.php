<?php

namespace ModelModuleTest\Model\HomePage;

use ModelModule\Model\HomePage\HomePagePutRemoveControllerHelper;
use ModelModuleTest\TestSuite;

class HomePagePutRemoveControllerHelperTest extends TestSuite
{
    /**
     * @var HomePagePutRemoveControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new HomePagePutRemoveControllerHelper();
        $this->helper->setConnection($this->getConnectionMock());
    }

    public function testInsertInHomePage()
    {
        $this->assertEquals($this->helper->insertInHomePage(1,1,1), 1);
    }

    public function testDeleteFromHomePage()
    {
        $this->assertEquals($this->helper->deleteFromHomePage(1, 1), 1);
    }

    public function testUpdateHomeFlag()
    {
        $this->assertEquals($this->helper->updateHomeFlag('dbTableTest', 1), 1);
    }

    public function testRecoverHomeFlagFromModuleCode()
    {
        $this->assertEquals($this->helper->recoverHomeFlagFromModuleCode('atti-concessione'), 'homepage');
        $this->assertEquals($this->helper->recoverHomeFlagFromModuleCode('contenuti'), 'home');
        $this->assertEquals($this->helper->recoverHomeFlagFromModuleCode('stato-civile'), 'homepage_flag');
    }
}
