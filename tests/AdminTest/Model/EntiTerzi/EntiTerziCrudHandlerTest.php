<?php

namespace AdminTest\Model\EntiTerzi;

use Admin\Model\Logs\LogsWriter;
use ApplicationTest\TestSuite;
use Admin\Model\EntiTerzi\EntiTerziCrudHandler;

/**
 * @author Andrea Fiori
 * @since  19 March 2015
 */
class EntiTerziCrudHandlerTest extends TestSuite
{
    /**
     * @var EntiTerziCrudHandler
     */
    private $crudHandler;

    private $formSampleData, $userDetailsSample;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new EntiTerziCrudHandler();

        $this->formSampleData = array(
            'id'     => '',
            'nome'   => 'Provincia Olbia Tempio<br>',
            'email'  => 'myEnteTest@myemail.com',
        );

        $this->userDetailsSample = new \stdClass();
        $this->userDetailsSample->id = 1;
        $this->userDetailsSample->name = 'John';
        $this->userDetailsSample->surname = 'Doe';
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $inputFilter = $this->recoverEntiTerziFormInputFilterInstance();

        $this->assertNotNull($inputFilter->id);
        $this->assertNotNull($inputFilter->nome);
        $this->assertNotNull($inputFilter->email);
    }

    public function testInsert()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->assertTrue( $this->crudHandler->insert($this->crudHandler->getFormInputFilter()) );
    }

    public function testUpdate()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->assertTrue( $this->crudHandler->update($this->crudHandler->getFormInputFilter()) );
    }

    public function testDelete()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->assertTrue( $this->crudHandler->delete(1) );
    }

    public function testLogInsertOK()
    {
        $this->setupLog('insert', true);

        $this->assertTrue( $this->crudHandler->log() );
    }

    public function testLogInsertKO()
    {
        $this->setupLog('insert', false);

        $this->assertTrue( $this->crudHandler->log() );
    }

    public function testLogUpdateOK()
    {
        $this->setupLog('update', true);

        $this->assertTrue( $this->crudHandler->log() );
    }

    public function testLogUpdateKO()
    {
        $this->setupLog('update', false);

        $this->assertTrue( $this->crudHandler->log() );
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetupLogMethodToExecuteThrowsException()
    {
        $this->crudHandler->setupLogMethodToExecute('unallowed', true);
    }

    public function testSetupLogMethodToExecute()
    {
        $this->crudHandler->setupLogMethodToExecute('insert', true);

        $this->assertEquals($this->crudHandler->getLogMethodToExecute(), 'logInsertOk');
    }

    private function setupFormInputFilterAndExchangeArray()
    {
        $this->crudHandler->getForm()->setData($this->formSampleData);

        $this->crudHandler->getForm()->setInputFilter($this->crudHandler->getFormInputFilter()->getInputFilter());

        $inputFilter = $this->recoverEntiTerziFormInputFilterInstance();

        $inputFilter->exchangeArray($this->formSampleData);
    }

    /**
     * @return \Admin\Model\EntiTerzi\EntiTerziFormInputFilter $inputFilter
     */
    private function recoverEntiTerziFormInputFilterInstance()
    {
        return $this->crudHandler->getFormInputFilter();
    }

    private function setupLog($operation, $ok)
    {
        $this->crudHandler->setUserDetails($this->userDetailsSample);

        $this->crudHandler->setLogsWriter( new LogsWriter($this->getConnectionMock()) );

        $this->crudHandler->setupLogMethodToExecute($operation, $ok);
    }
}