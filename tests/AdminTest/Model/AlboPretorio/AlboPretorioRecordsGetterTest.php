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
    private $alboPretorioRecordsGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioRecordsGetter = new AlboPretorioRecordsGetter( $this->getFrontendCommonInput() );
    }
    
    public function testSetArticoliInput()
    {
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->alboPretorioRecordsGetter->setArticoliInput(array()));
    }
    
    public function testSetArticoliPaginator()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->alboPretorioRecordsGetter->setArticoliPaginator(1));
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetArticoliPaginatorCurrentPageThrowsNullException()
    {
        $this->alboPretorioRecordsGetter->setArticoliPaginatorCurrentPage(1);
    }
  
    public function testSetArticoliPaginatorCurrentPage()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->alboPretorioRecordsGetter->setArticoliPaginatorCurrentPage(1));
    }
    
    public function testSetArticoliPaginatorPerPage()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Admin\Model\AlboPretorio\AlboPretorioGetterWrapper', $this->alboPretorioRecordsGetter->setArticoliPaginatorPerPage(25));
    }
    
    public function testGetPaginatorRecords()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Zend\Paginator\Paginator', $this->alboPretorioRecordsGetter->getPaginatorRecords());
    }
    
        /**
         * Setup Articoli Input and Paginator
         * 
         * @param type $input
         */
        private function setupArticoliWithPaginator( $input = array() )
        {
            $this->alboPretorioRecordsGetter->setArticoliInput(array());
            $this->alboPretorioRecordsGetter->setArticoliPaginator();
        }
}