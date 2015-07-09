<?php

namespace ModelModuleTest\Model\StatoCivile\Sezioni;

use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetterWrapper;
use ModelModuleTest\TestSuite;

class StatoCivileSezioniGetterWrapperTest extends TestSuite
{
    /**
     * @var StatoCivileSezioniGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new StatoCivileSezioniGetterWrapper(
            new StatoCivileSezioniGetter($this->getEntityManagerMock())
        );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}