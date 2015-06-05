<?php

namespace ModelModuleTest\Model\FormData;

use ModelModule\Model\Log\LogWriter;
use ModelModuleTest\TestSuite;

class CrudHandlerAbstractTest extends TestSuite
{
    /**
     * @var \ModelModule\Model\FormData\CrudHandlerAbstract
     */
    private $crudHandlerAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->crudHandlerAbstract = $this->getMockForAbstractClass('\ModelModule\Model\FormData\CrudHandlerAbstract');
    }

    public function testSetEntityManager()
    {
        $this->crudHandlerAbstract->setEntityManager( $this->getEntityManagerMock() );

        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $this->crudHandlerAbstract->getEntityManager());
    }

    public function testSetConnection()
    {
        $this->crudHandlerAbstract->setConnection( $this->getConnectionMock() );

        $this->assertInstanceOf('\Doctrine\DBAL\Connection', $this->crudHandlerAbstract->getConnection());
    }

    public function testSetConfigurationsFromDb()
    {
        $configurations = array(
            'sitename' => 'My website',
            'seo_title' => 'My website title'
        );

        $this->crudHandlerAbstract->setConfigurationsFromDb($configurations);

        $this->assertEquals($configurations, $this->crudHandlerAbstract->getConfigurationsFromDb());
    }

    public function testSetupErrorMessage()
    {
        $errorMessageArray = $this->crudHandlerAbstract->setupErrorMessage('This is a test error message');

        $this->assertTrue( !empty($errorMessageArray) );
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testSetupLogMethodToExecuteThrowsException()
    {
        $this->crudHandlerAbstract->setupLogMethodToExecute('unvalidLogMethod', 1);
    }

    public function testSetupLogMethodToExecute()
    {
        $this->assertEquals('logInsertOk', $this->crudHandlerAbstract->setupLogMethodToExecute('insert', true));
        $this->assertEquals('logInsertKo', $this->crudHandlerAbstract->setupLogMethodToExecute('insert', false));
        $this->assertEquals('logUpdateOk', $this->crudHandlerAbstract->setupLogMethodToExecute('update', true));
        $this->assertEquals('logUpdateKo', $this->crudHandlerAbstract->setupLogMethodToExecute('update', false));
        $this->assertEquals('logDeleteOk', $this->crudHandlerAbstract->setupLogMethodToExecute('delete', true));
        $this->assertEquals('logDeleteKo', $this->crudHandlerAbstract->setupLogMethodToExecute('delete', false));
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testLogThrowsFirstException()
    {
        $this->crudHandlerAbstract->log();
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testLogThrowsSecondException()
    {
        $this->crudHandlerAbstract->setupLogMethodToExecute('insert', true);

        $this->crudHandlerAbstract->log();
    }

    public function testSetupSuccess()
    {
        $errorMessageArray = $this->crudHandlerAbstract->setupSuccessMessage('This is a success message');

        $this->assertTrue( !empty($errorMessageArray) );
    }

    public function testSetupVariablesForTheView()
    {
        $this->assertTrue( is_array($this->crudHandlerAbstract->setupVariablesForTheView('insert', true)) );
        $this->assertTrue( is_array($this->crudHandlerAbstract->setupVariablesForTheView('insert', false)) );
        $this->assertTrue( is_array($this->crudHandlerAbstract->setupVariablesForTheView('update', true)) );
        $this->assertTrue( is_array($this->crudHandlerAbstract->setupVariablesForTheView('update', false)) );
    }

    public function testSetLogWriter()
    {
        $this->crudHandlerAbstract->setLogWriter( new LogWriter($this->getConnectionMock()) );

        $this->assertInstanceOf('\ModelModule\Model\Log\LogWriter', $this->crudHandlerAbstract->getLogWriter());
    }
}