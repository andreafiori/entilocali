<?php

namespace AdminTest\Model\StatoCivile;

use ApplicationTest\TestSuite;
use Admin\Model\StatoCivile\StatoCivileFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileFormDataHandlerTest //extends TestSuite
{
    private $statoCivileFormDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->statoCivileFormDataHandler = new StatoCivileFormDataHandler();
    }
}