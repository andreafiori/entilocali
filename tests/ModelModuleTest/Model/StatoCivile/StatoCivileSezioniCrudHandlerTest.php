<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\CrudHandlerTestSuite;
use ModelModule\Model\StatoCivile\StatoCivileSezioniCrudHandler;

/**
 * @author Andrea Fiori
 * @since  22 March 2015
 */
class StatoCivileSezioniCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var StatoCivileSezioniCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new StatoCivileSezioniCrudHandler();

        $this->formSampleData = array(
            'id'     => '',
            'nome'   => 'Nuova sezione',
            'attivo'  => '1',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->nome);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->attivo);
    }
}
