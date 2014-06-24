<?php

namespace AdminTest\Model\HomePage;

use ApplicationTest\TestSuite;
use Application\Model\HomePage\HomePageSetup;

/**
 * @author Andrea Fiori
 * @since  23 June 2014
 */
class HomePageSetupTest extends TestSuite
{
    private $homePageSetup;
    
    private $fakeHomePageInput;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->homePageSetup = new HomePageSetup($this->getFrontendCommonInput());
        
        $this->fakeHomePageInput = array( 
            1 => array('referenceId'=>3, 'position' => 1, 'module'=>1),
            4 => array('referenceId'=>1, 'position' => 2, 'module'=>4),
        );
    }
    
    public function testSetHomePageInput()
    {
        $this->assertFalse( $this->homePageSetup->setHomePageInput() );
        
        $this->assertTrue( is_array($this->homePageSetup->setHomePageInput($this->fakeHomePageInput)) );
    }
}