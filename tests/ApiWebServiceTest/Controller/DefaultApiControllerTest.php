<?php

namespace ApiWebService\Controller;

use ApplicationTest\TestSuite;
use ApiWebService\Controller\DefaultApiController;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class DefaultApiControllerTest //extends TestSuite
{
    private $defaultApiController;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->defaultApiController = new DefaultApiController();
    }
    
    public function testIndexActionCanBeAccessed()
    {
        
    }
}