<?php

namespace AdminTest\Model\Contenuti;

use ApplicationTest\CrudHandlerTestSuite;
use Admin\Model\Contenuti\ContenutiCrudHandler;

/**
 * @author Andrea Fiori
 * @since  20 March 2015
 */
class ContenutiCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var ContenutiCrudHandler
     */
    protected $crudHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new ContenutiCrudHandler();

        $this->formSampleData = array(
            'id'                => '',
            'sottosezione'      => 1,
            'titolo'            => 'Titolo contenuto',
            'sommario'          => 'Testo sommario contenuto di prova',
            'testo'             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'dataInserimento'   => date("Y-m-d H:i:s"),
            'dataScadenza'      => date("Y-m-d H:i:s"),
            'attivo'            => 1,
            'homepage'          => 1,
            'utente'            => 1,
            'facebook'          => '',
            'rss'               => 1,
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->sottosezione);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->titolo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->sommario);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->testo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->dataInserimento);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->dataScadenza);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->attivo);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->homepage);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->utente);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->facebook);
        // $this->assertNotNull($this->crudHandler->getFormInputFilter()->rss);
    }


}