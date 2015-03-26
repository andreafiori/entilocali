<?php

namespace AdminTest\Model\Sezioni;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\Sezioni\SottoSezioniCrudHandler;

/**
 * @author Andrea Fiori
 * @since  22 March 2015
 */
class SottoSezioniCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var SezioniCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new SottoSezioniCrudHandler();

        $this->formSampleData = array(
            'idSottoSezione'   => '',
            'sezione'          => 1,
            'nomeSottoSezione' => 'Sottosezione di test',
            'attivo'           => 1,
            'url'              => 'http://www.myurltest.com',
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->idSottoSezione);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->nomeSottoSezione);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->attivo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->url);
    }
}