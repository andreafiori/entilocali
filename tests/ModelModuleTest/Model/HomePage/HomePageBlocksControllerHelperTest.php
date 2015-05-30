<?php

namespace ModelModuleTest\Model\HomePage;

use ModelModule\Model\HomePage\HomePageBlocksGetter;
use ModelModule\Model\HomePage\HomePageBlocksGetterWrapper;
use ModelModule\Model\HomePage\HomePageControllerHelper;
use ModelModuleTest\TestSuite;

class HomePageBlocksControllerHelperTest extends TestSuite
{
    /**
     * @var HomePageControllerHelper
     */
    private $helper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->helper = new HomePageControllerHelper();
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
}