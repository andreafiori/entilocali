<?php

namespace AdminTest\Model\ContrattiPubblici;

use Admin\Model\ContrattiPubblici\ContrattiPubbliciCrudHandler;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteCrudHandler;
use ApplicationTest\CrudHandlerTestSuite;

class ContrattiPubbliciCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var ContrattiPubbliciCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new ContrattiPubbliciCrudHandler();

        $this->formSampleData = array(
            'id'                => '',
            'cig'               => '1223123243',
            'titolo'            => 'Titolo Contratto Pubblico',
            'importoAggiudicazione' => 1234.42,
            'importoLiquidato'  => 1234.42,
            'scContr'           => 1,
            'respProc'          => 2,
            'inserimento'       => '2015-04-12 01:00:00',
            'numeroOfferte'     => 1,
            'data_agg'          => '2015-04-12 01:00:00',
            'data_contratto'    => '2015-04-12 01:00:00',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->cig);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->titolo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->importoAggiudicazione);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->importoLiquidato);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->scContr);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->respProc);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->inserimento);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->numeroOfferte);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->data_agg);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->data_contratto);
    }
}
