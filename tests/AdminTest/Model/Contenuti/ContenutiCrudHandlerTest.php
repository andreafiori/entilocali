<?php

namespace AdminTest\Model\Contenuti;

use Admin\Model\Contenuti\ContenutiForm;
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
            'dataInserimento'   => '2015-03-12 01:00:00',
            'dataScadenza'      => '2020-03-12 01:00:00',
            'attivo'            => 1,
            'homepage'          => 1,
            'utente'            => 1,
            'facebook'          => '',
            'rss'               => 1,
        );

        $this->crudHandler->setForm($this->buildForm());
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
    }

    /**
     * @return ContenutiForm
     */
    private function buildForm()
    {
        $form = new ContenutiForm();
        $form->addForm();
        $form->addUsers(array(
            1 => 'Mad Max',
            2 => 'Chuck Norris'
        ));
        $form->addSottoSezioni(array(
            1 => 'Sezione 1',
            2 => 'Sezione 2',
        ));
        $form->addHomeBox();
        $form->addSocial();

        return $form;
    }
}