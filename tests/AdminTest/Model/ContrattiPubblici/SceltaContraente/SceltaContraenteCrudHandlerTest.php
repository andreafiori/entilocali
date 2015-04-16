<?php

namespace AdminTest\Model\ContrattiPubblici\SceltaContraente;

use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteCrudHandler;
use ApplicationTest\CrudHandlerTestSuite;

class SceltaContraenteCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var SceltaContraenteCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new SceltaContraenteCrudHandler();

        $this->formSampleData = array(
            'id'                    => '',
            'nomeScelta'            => 'Voce scelta contraente',
            'attivo'                => 1,
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->nomeScelta);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->attivo);
    }
}
