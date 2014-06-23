<?php

namespace AdminTest\Model\HomePage;

use ApplicationTest\TestSuite;
use Application\Model\HomePage\HomePageRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  22 June 2014
 */
class HomePageRecordsGetterTest extends TestSuite
{
    private $homePageRecordsGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->homePageRecordsGetter = new HomePageRecordsGetter($this->getEntityManagerMock());
    }
    
    public function testSetMainQuery()
    {
        $this->homePageRecordsGetter->setMainQuery();
        
        $this->assertTrue(is_object($this->homePageRecordsGetter->getQueryBuilder()) );
    }
}