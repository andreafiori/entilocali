<?php

namespace ModelModuleTest\Model\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliCrudHandler;
use ModelModuleTest\CrudHandlerTestSuite;

class AlboPretorioArticoliCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var AlboPretorioArticoliCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new AlboPretorioArticoliCrudHandler();

        $this->formSampleData = array(
            'id'                    => '',
            'titolo'               => 'Atto Albo Pretorio test',
            'anno'                  => date("Y"),
            'enteTerzo'             => 'Provincia Olbia Tempio',
            'fonteUrl'              => 'http://www.provincia.olbiatempio.it',
            'numeroGiorniScadenza'  => 11,
            'dataScadenza'          => '0000-00-00 00:00:00',
            'sezione'               => 1,
            'numeroProgressivo'     => '',
            'numeroAtto'            => 1,
            'dataAttivazione'       => date("Y-m-d H:i:s"),
            'oraAttivazione'        => date("H:i:s"),
            'dataPubblicare'        => date("Y-m-d H:i:s"),
            'oraPubblicare'         => date("H:i:s"),
            'dataScadenza'          => date("Y-m-d H:i:s"),
            'pubblicare'            => 0,
            'annullato'             => 0,
            'checkInviaRegione'     => '',
            'annoAtto'              => date("Y"),
            'fonteUrl'              => '',
            'utente'                => '',
            'userId'                => '',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->titolo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->anno);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->enteTerzo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->fonteUrl);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->numeroGiorniScadenza);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->dataScadenza);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->userId);
        /*
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->pubblicare);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->annullato);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->annoAtto);
        */
    }
}