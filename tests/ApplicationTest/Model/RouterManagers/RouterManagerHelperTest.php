<?php

namespace ApplicationTest\Model\RouterManagers;

use Admin\Model\AlboPretorio\AlboPretorioSezioniFormDataHandler;
use Admin\Model\FormData\FormDataHandler;
use Application\Model\RouterManagers\RouterManagerHelper;
use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  14 May 2014
 */
class RouterManagerHelperTest extends TestSuite
{
    private $routerManagerHelper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->routerManagerHelper = new RouterManagerHelper( new FormDataHandler() );
    }
    
    public function testGetRouterManger()
    {
        $this->assertInstanceOf(
            'Application\Model\RouterManagers\RouterManagerAbstract',
            $this->routerManagerHelper->getRouterManger()
        );
    }
}
