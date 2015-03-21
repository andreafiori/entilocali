<?php

namespace AdminTest\Model\FormData;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
class CrudHandlerAbstractTest // extends TestSuite
{
    /**
     * @var \Admin\Model\FormData\CrudHandlerAbstract
     */
    private $crudHandlerAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->crudHandlerAbstract = $this->getMockForAbstractClass('\Admin\Model\FormData\CrudHandlerAbstract', array($this->getFrontendCommonInput()) );
    }

    public function testSetConnection()
    {
        $this->assertInstanceOf('\Doctrine\DBAL\Connection', $this->crudHandlerAbstract->setConnection($this->getConnectionMock()));
    }
}