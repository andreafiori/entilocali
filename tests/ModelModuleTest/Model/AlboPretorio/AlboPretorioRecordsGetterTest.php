<?php

namespace ModelModuleTest\Model\AlboPretorio;

use ModelModuleTest\TestSuite;
use ModelModule\Model\AlboPretorio\AlboPretorioRecordsGetter;

class AlboPretorioRecordsGetterTest //extends TestSuite
{
    /**
     * @var AlboPretorioRecordsGetter
     */
    private $objectGetter;
    
    private $articoliGetterWrapperNamespace;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AlboPretorioRecordsGetter($this->getFrontendCommonInput());
        
        $this->articoliGetterWrapperNamespace = '\ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper';
    }
    
    public function testSetArticoliInput()
    {
        $this->assertInstanceOf($this->articoliGetterWrapperNamespace, $this->objectGetter->setArticoliInput(array()));
    }
    
    public function testSetArticoliPaginator()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf($this->articoliGetterWrapperNamespace, $this->objectGetter->setArticoliPaginator(1));
    }
    
    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testSetArticoliPaginatorCurrentPageThrowsNullException()
    {
        $this->objectGetter->setArticoliPaginatorCurrentPage(1);
    }

    public function testSetArticoliPaginatorCurrentPage()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf($this->articoliGetterWrapperNamespace, $this->objectGetter->setArticoliPaginatorCurrentPage(1));
    }
    
    public function testSetArticoliPaginatorPerPage()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf($this->articoliGetterWrapperNamespace, $this->objectGetter->setArticoliPaginatorPerPage(25));
    }
    
    public function testGetPaginatorRecords()
    {
        $this->setupArticoliWithPaginator();
        
        $this->assertInstanceOf('\Zend\Paginator\Paginator', $this->objectGetter->getPaginatorRecords());
    }
    
    public function testSetSezioni()
    {
        $this->objectGetter->setSezioni( array('FirstSection','SecondSection','ThirdSecton') );

        $this->assertNotEmpty($this->objectGetter->getRecords());
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