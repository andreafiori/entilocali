<?php

namespace ApplicationTest\Model\Categorie;

use ApplicationTest\TestSuite;
use Application\Model\Categorie\CategorieGetter;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
class CategorieGetterTest extends TestSuite
{
    private $categorieGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->categorieGetter = new CategorieGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->categorieGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->categorieGetter->getQueryResult()) );
    } 
}