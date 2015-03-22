<?php

namespace AdminTest\Model\Sezioni;

use ApplicationTest\TestSuite;
use Admin\Model\Sezioni\SezioniCrudHandler;

/**
 * @author Andrea Fiori
 * @since  22 March 2015
 */
class EntiTerziCrudHandlerTest extends TestSuite
{
    /**
     * @var SezioniCrudHandler
     */
    private $crudHandler;

    private $formSampleData, $userDetailsSample;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new SezioniCrudHandler();

        $this->formSampleData = array(
            'id' => '',
        );

        $this->userDetailsSample = new \stdClass();
        $this->userDetailsSample->id = 1;
        $this->userDetailsSample->name = 'John';
        $this->userDetailsSample->surname = 'Doe';
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->recoverEntiTerziFormInputFilterInstance()->id);
    }

    public function testInsert()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setUserDetails($this->userDetailsSample);

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->assertTrue( $this->crudHandler->insert($this->crudHandler->getFormInputFilter()) );
    }

    public function testUpdate()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setUserDetails($this->userDetailsSample);

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->assertTrue( $this->crudHandler->update( $this->crudHandler->getFormInputFilter()) );
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

        $this->recoverEntiTerziFormInputFilterInstance()->exchangeArray($this->formSampleData);
    }

    /**
     * @return \Admin\Model\Sezioni\SezioniFormInputFilter $inputFilter
     */
    private function recoverEntiTerziFormInputFilterInstance()
    {
        return $this->crudHandler->getFormInputFilter();
    }
}