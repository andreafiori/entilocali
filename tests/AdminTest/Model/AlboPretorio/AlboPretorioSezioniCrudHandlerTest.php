<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\AlboPretorio\AlboPretorioSezioniCrudHandler;

/**
 * @author Andrea Fiori
 * @since  26 October 2014
 */
class AlboPretorioSezioniCrudHandlerTest extends CrudHandlerTestSuite
{
    protected $crudHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->crudHandler = new AlboPretorioSezioniCrudHandler();

        $this->formSampleData = array(
            'id'        => '',
            'nome'      => 'Sezione albo pretorio di test',
            'attivo'    => '1',
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