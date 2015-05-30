<?php

namespace ModelModuleTest\Model\Atticoncessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneCrudHandler;
use ModelModule\Model\AttiConcessione\AttiConcessioneForm;
use ModelModuleTest\CrudHandlerTestSuite;

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

        $this->crudHandler->setForm($this->buildForm());

        $this->formSampleData = array(
            'id'                    => '',
            'beneficiario'          => 'John Doe',
            'ufficioResponsabile'   => 1,
            'respProc'              => 'John Doe',
            'importo'               => 2000,
            'modAssegnazione'       => 1,
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
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->modAssegnazione);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->titolo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->dataInserimento);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->anno);
    }

    protected function buildForm()
    {
        $form = new AttiConcessioneForm();
        $form->addUfficioResponsabile(array(
            1 => 'Responsabile 1',
            2 => 'Responsabile 2'
        ));
        $form->addModalitaAssegnazione(array(
            1 => 'Modalita 1',
            2 => 'Modalita 2'
        ));
        $form->addUfficioResponsabile(array(
            1 => 'Resp 1',
            2 => 'Resp 2'
        ));
        $form->addTitoloDataInserimentoEAnno();

        return $form;
    }
}