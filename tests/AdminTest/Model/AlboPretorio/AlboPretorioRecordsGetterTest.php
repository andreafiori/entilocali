<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  16 August 2014
 */
class AlboPretorioRecordsGetterTest extends TestSuite
{
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AlboPretorioRecordsGetter( $this->getFrontendCommonInput() );
    }
    
    public function testSetArticoliInput()
    {
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->objectGetter->setArticoliInput(array()));
    }
    
    public function testSetArticoliPaginator()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->objectGetter->setArticoliPaginator(1));
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetArticoliPaginatorCurrentPageThrowsNullException()
    {
        $this->objectGetter->setArticoliPaginatorCurrentPage(1);
    }
  
    public function testSetArticoliPaginatorCurrentPage()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->objectGetter->setArticoliPaginatorCurrentPage(1));
    }
    
    public function testSetArticoliPaginatorPerPage()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->objectGetter->setArticoliPaginatorPerPage(25));
    }
    
    public function testGetPaginatorRecords()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Zend\Paginator\Paginator', $this->objectGetter->getPaginatorRecords());
    }
    
        /**
         * Setup Articoli Input and Paginator
         * 
         * @param type $input
         */
        private function setupArticoliWithPaginator( $input = array() )
        {
            $this->objectGetter->setArticoliInput($input);
            $this->objectGetter->setArticoliPaginator();
        }
}