<?php

namespace ModelModuleTest\Model\EntiTerzi;

use ModelModuleTest\CrudHandlerTestSuite;
use ModelModule\Model\EntiTerzi\EntiTerziCrudHandler;

/**
 * @author Andrea Fiori
 * @since  19 March 2015
 */
class EntiTerziCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var EntiTerziCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData, $userDetailsSample;

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

        $inputFilter = $this->crudHandler->getFormInputFilter();

        $this->assertNotNull($inputFilter->id);
        $this->assertNotNull($inputFilter->nome);
        $this->assertNotNull($inputFilter->email);
    }
}