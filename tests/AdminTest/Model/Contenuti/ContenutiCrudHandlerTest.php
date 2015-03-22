<?php

namespace AdminTest\Model\Contenuti;

use ApplicationTest\TestSuite;
use Admin\Model\Contenuti\ContenutiCrudHandler;

/**
 * @author Andrea Fiori
 * @since  20 March 2015
 */
class EntiTerziCrudHandlerTest extends TestSuite
{
    /**
     * @var ContenutiCrudHandler
     */
    private $crudHandler;

    private $formSampleData, $userDetailsSample;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new ContenutiCrudHandler();

        $this->formSampleData = array(
            'id'                => '',
            'sottosezione'      => '1',
            'titolo'            => 'Titolo contenuto',
            'sommario'          => 'Testo sommario contenuto di prova',
            'testo'             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'dataInserimento'   => date("Y-m-d H:i:s"),
            'attivo'            => 1,
            'home'              => 1,
            'rss'               => 1,
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

            $this->recoverEntiTerziFormInputFilterInstance()->exchangeArray($this->formSampleData);
        }

    /**
     * @return \Admin\Model\Contenuti\ContenutiFormInputFilter $inputFilter
     */
    private function recoverEntiTerziFormInputFilterInstance()
    {
        return $this->crudHandler->getFormInputFilter();
    }
}