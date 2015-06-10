<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use ModelModuleTest\TestSuite;

class StatoCivileGetterWrapperTest extends TestSuite
{
    /**
     * @var StatoCivileGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new StatoCivileGetterWrapper(new StatoCivileGetter($this->getEntityManagerMock()));
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }

    public function testFormatYears()
    {
        $years = $this->objectWrapper->formatYears(
            array(
                'anno' => 2014
            ),
            array(
                'anno' => 2015
            )
        );

        $this->assertTrue( is_array($years) );
    }
}