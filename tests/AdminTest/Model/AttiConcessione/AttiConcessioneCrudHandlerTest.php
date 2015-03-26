<?php

namespace AdminTest\Model\Atticoncessione;

use Admin\Model\AttiConcessione\AttiConcessioneCrudHandler;
use ApplicationTest\CrudHandlerTestSuite;

/**
 * @author Andrea Fiori
 * @since  23 March 2015
 */
class AttiConcessioneCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var AttiConcessioneCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new AttiConcessioneCrudHandler();

        $this->formSampleData = array(
            'id'                    => '',
            'beneficiario'          => 'John Doe',
            'ufficioResponsabile'   => 'John Doe',
            'respProc'              => 'John Doe',
            'importo'               => 2000,
            'modassegn'             => 'Assign to this test',
            'titolo'                => 'My subject',
            'dataInserimento'       => '2015-03-24 20:30:00',
            'anno'                  => 2015
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->beneficiario);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->ufficioResponsabile);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->respProc);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->modassegn);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->titolo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->dataInserimento);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->anno);
    }
}