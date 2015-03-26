<?php

namespace AdminTest\Model\Sezioni;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\Sezioni\SezioniCrudHandler;

/**
 * @author Andrea Fiori
 * @since  22 March 2015
 */
class SezioniCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var SezioniCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new SezioniCrudHandler();

        $this->formSampleData = array(
            'id'        => '',
            'nome'      => 'Sezione di test',
            'lingua'    => 'it',
            'url'       => '',
            'image'     => '',
            'colonna'   => 'sx',
            'attivo'    => '1',
            'blocco'    => '0',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->nome);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->lingua);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->url);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->image);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->colonna);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->attivo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->blocco);
    }
}