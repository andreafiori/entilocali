<?php

namespace AdminTest\Model\Users\Settori;

use Admin\Model\Users\Settori\UsersSettoriCrudHandler;
use ApplicationTest\CrudHandlerTestSuite;

/**
 * @author Andrea Fiori
 * @since  29 March 2015
 */
class UsersSettoriCrudHandlerTest extends CrudHandlerTestSuite
{
    /**
     * @var UsersSettoriCrudHandler
     */
    protected $crudHandler;

    protected $formSampleData;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new UsersSettoriCrudHandler();

        $this->crudHandler->getForm()->addResponsabile(array(
            1 => 'Responsabile 1',
            2 => 'Responsabile 2',
        ));

        $this->formSampleData = array(
            'id'                    => '',
            'nome'                  => 'Settore finanziario',
            'responsabileUserId'    => 1,
        );
    }

    public function testExchangeArray()
    {
        $this->setupFormInputFilterAndExchangeArray();

        $this->assertNotNull($this->crudHandler->getFormInputFilter()->id);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->nome);
        $this->assertNotNull($this->crudHandler->getFormInputFilter()->responsabileUserId);
    }
}