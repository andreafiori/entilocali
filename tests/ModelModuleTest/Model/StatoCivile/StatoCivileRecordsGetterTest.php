<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\TestSuite;
use ModelModule\Model\StatoCivile\StatoCivileRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class StatoCivileRecordsGetterTest extends TestSuite
{
    /**
     * @var StatoCivileRecordsGetter
     */
    private $recordsGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->recordsGetter = new StatoCivileRecordsGetter( $this->getFrontendCommonInput() );
    }
    
    public function testSetArticoli()
    {
        $this->recordsGetter->setArticoli(array());

        $this->assertTrue( is_array($this->recordsGetter->getRecords()) );
    }
    
    public function testSetSezioni()
    {
        $this->recordsGetter->setSezioni(array());
        
        $this->assertTrue( is_array($this->recordsGetter->getRecords()) );
    }
}