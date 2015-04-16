<?php

namespace AdminTest\Model\HomePage;

use ApplicationTest\TestSuite;
use Application\Model\HomePage\HomePageRecordsGetter;
use Application\Model\HomePage\HomePageRecordsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 June 2014
 */
class HomePageRecordsGetterWrapperTest extends TestSuite
{
    /**
     * @var HomePageRecordsGetterWrapper
     */
    private $homePageRecordsGetterWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->homePageRecordsGetterWrapper = new HomePageRecordsGetterWrapper(
            new HomePageRecordsGetter($this->getEntityManagerMock()
        ));
    }
    
    public function testSetupQueryBuilder()
    {
        $this->homePageRecordsGetterWrapper->setupQueryBuilder();
        
        $this->assertTrue( is_object($this->homePageRecordsGetterWrapper->getObjectGetter()) );
    }
    
    public function testGetRecords()
    {
        $this->homePageRecordsGetterWrapper->setupQueryBuilder();
        
        $this->assertTrue(is_array($this->homePageRecordsGetterWrapper->getRecords()) );
    }
}