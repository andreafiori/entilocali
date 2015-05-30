<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\CrudHandlerTestSuite;
use ModelModule\Model\StatoCivile\StatoCivileCrudHandler;

/**
 * @author Andrea Fiori
 * @since  22 March 2015
 */
class StatoCivileCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var StatoCivileSezioniCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new StatoCivileCrudHandler();

        $this->formSampleData = array(
            'id'        => '',
            'titolo'    => 'Nuova sezione',
            'sezione'   => 1,
            'attivo'    => 1,
            'data'      => '2015-03-24 01:00:00',
            'scadenza'  => '2015-03-24 01:00:00',
            'home'      => 0,
            'utente'    => '',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->titolo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->sezione);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->attivo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->data);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->scadenza);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->home);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->utente);
    }
}