<?php

namespace AdminTest\Model\AttiConcessione\ModalitaAssegnazione;

use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneCrudHandler;
use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneForm;
use ApplicationTest\CrudHandlerTestSuite;

class AttiConcessioneModalitaAssegnazioneCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var AttiConcessioneCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new AttiConcessioneModalitaAssegnazioneCrudHandler();

        $this->crudHandler->setForm(new AttiConcessioneModalitaAssegnazioneForm());

        $this->formSampleData = array(
            'id' => '',
            'nome' => 'Modalita 1',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->nome);
    }
}