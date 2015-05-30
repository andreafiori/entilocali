<?php

namespace ApplicationTest\Model\RouterManagers;

use ModelModule\Model\AlboPretorio\AlboPretorioSezioniFormDataHandler;
use ModelModule\Model\FormData\FormDataHandler;
use ModelModule\Model\RouterManagers\RouterManagerHelper;
use ModelModuleTest\TestSuite;

class RouterManagerHelperTest extends TestSuite
{
    /**
     * @var RouterManagerHelper
     */
    private $routerManagerHelper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->routerManagerHelper = new RouterManagerHelper( new FormDataHandler() );
    }
    
    public function testGetRouterManger()
    {
        $this->assertInstanceOf(
            '\ModelModule\Model\RouterManagers\RouterManagerAbstract',
            $this->routerManagerHelper->getRouterManger()
        );
    }
}
