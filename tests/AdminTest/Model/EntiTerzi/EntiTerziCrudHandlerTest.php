<?php

namespace AdminTest\Model\EntiTerzi;

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

    private $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new EntiTerziCrudHandler();

        $this->formSampleData = array(
            'id'     => '',
            'nome'   => 'Provincia Olbia Tempio<br>',
            'email'  => 'myEnteTest@myemail.com',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->nome);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->email);
    }

    public function testInsert()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->crudHandler->insert( $this->crudHandler->getFormInputFilter() );
    }

    public function testUpdate()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->crudHandler->update( $this->crudHandler->getFormInputFilter() );
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

            $this->crudHandler->getFormInputFilter()->exchangeArray($this->formSampleData);
        }


}