<?php

namespace AdminTest\Model\AttiConcessione;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\AttiConcessione\AttiConcessioneSettoriCrudHandler;

/**
 * @author Andrea Fiori
 * @since  23 March 2015
 */
class AttiConcessioneSettoriCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var AttiConcessioneSettoriCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new AttiConcessioneSettoriCrudHandler();

        $this->formSampleData = array(
            'id'            => '',
            'nome'          => 'Nuovo settore atti concessione test',
            'responsabile'  => 'Superman',
            'attivo'        => 1,
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
    }
}