<?php

namespace ModelModuleTest;

use ModelModule\Model\Log\LogWriter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Execute common CRUD handler test methods (TO DELETE in future...)
 *
 * @author Andrea Fiori
 * @since  22 March 2015
 */
abstract class CrudHandlerTestSuite extends TestSuite
{
    protected $validInputFilterObject;

    /**
     * @var \ModelModule\Model\FormData\CrudHandlerAbstract
     */
    protected $crudHandler;

    protected $formSampleData, $userDetailsSample;

    protected function setUp()
    {
        parent::setUp();

        $this->userDetailsSample = new \stdClass();
        $this->userDetailsSample->id = 1;
        $this->userDetailsSample->name = 'John';
        $this->userDetailsSample->surname = 'Doe';
    }

    public function testFormIsValid()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertTrue( $this->crudHandler->getForm()->isValid() );
    }

    public function testValidateFormData()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $formInputFilter = $this->crudHandler->validateFormData($this->crudHandler->getFormInputFilter());

        $this->assertTrue( empty($formInputFilter) );
    }

    public function testInsert()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setEntityManager($this->getEntityManagerMock());

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->crudHandler->setUserDetails($this->userDetailsSample);

        $this->assertTrue( $this->crudHandler->insert($this->crudHandler->getFormInputFilter()) );
    }

    public function testUpdate()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->setEntityManager($this->getEntityManagerMock());

        $this->crudHandler->setConnection($this->getEntityManagerMock()->getConnection());

        $this->crudHandler->setUserDetails($this->userDetailsSample);

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
     * @expectedException \ModelModule\Model\NullException
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

    protected function setupFormInputFilterAndExchangeArray()
    {
        $this->crudHandler->getForm()->setInputFilter($this->crudHandler->getFormInputFilter()->getInputFilter());

        $this->crudHandler->getForm()->setData($this->formSampleData);

        $this->crudHandler->getFormInputFilter()->exchangeArray($this->formSampleData);
    }

    protected function setupLog($operation, $ok)
    {
        $this->crudHandler->setUserDetails($this->userDetailsSample);

        $this->crudHandler->setLogWriter( new LogWriter($this->getConnectionMock()) );

        $this->crudHandler->setupLogMethodToExecute($operation, $ok);
    }

    /**
     * Print unvalid form fields (DEBUG)
     */
    protected function printInvalidFormFields()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->crudHandler->getForm()->isValid();

        $formValidationErrors = $this->crudHandler->getFormInputFilter()->getInputFilter()->getInvalidInput();
        foreach($formValidationErrors as $key => $value) {
            echo $key."\n";
        }
    }
}