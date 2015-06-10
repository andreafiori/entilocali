<?php

namespace ModelModuleTest\Model;

use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModuleTest\TestSuite;

class RecordsGetterWrapperAbstractTest extends TestSuite
{
    /**
     * @var \ModelModule\Model\RecordsGetterWrapperAbstract
     */
    private $recordsGetterWrapperAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->recordsGetterWrapperAbstract = $this->getMockForAbstractClass(
            '\ModelModule\Model\RecordsGetterWrapperAbstract'
        );
    }
    
    public function testSetInput()
    {
        $this->assertTrue( is_array($this->recordsGetterWrapperAbstract->setInput($this->getFrontendCommonInput())) );
    }
    
    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testGetRecordsThrowsException()
    {
        $this->recordsGetterWrapperAbstract->getRecords();
    }

    public function testSetObjectGetter()
    {
        $this->recordsGetterWrapperAbstract->setObjectGetter(new ContenutiGetter($this->getEntityManagerMock()));

        $this->assertInstanceOf(
            '\ModelModule\Model\QueryBuilderHelperAbstract',
            $this->recordsGetterWrapperAbstract->getObjectGetter()
        );
    }

    public function testSetEntityManager()
    {
        $this->recordsGetterWrapperAbstract->setEntityManager($this->getEntityManagerMock());

        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $this->recordsGetterWrapperAbstract->getEntityManager());
    }
}
