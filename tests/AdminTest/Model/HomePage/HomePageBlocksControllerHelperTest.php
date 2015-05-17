<?php

namespace AdminTest\Model\HomePage;

use Admin\Model\HomePage\HomePageBlocksGetter;
use Admin\Model\HomePage\HomePageBlocksGetterWrapper;
use Admin\Model\HomePage\HomePageControllerHelper;
use ApplicationTest\TestSuite;

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
            '\Admin\Model\HomePage\HomePageBlocksGetterWrapper',
            $this->helper->getHomePageBlocksGetterWrapper()
        );
    }
}