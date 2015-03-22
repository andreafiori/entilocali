<?php

namespace AdminTest\Model\StatoCivile;

use ApplicationTest\TestSuite;
use Admin\Model\StatoCivile\StatoCivileSezioniCrudHandler;

/**
 * @author Andrea Fiori
 * @since  22 March 2015
 */
class StatoCivileSezioniCrudHandlerTest // extends TestSuite
{
    /**
     * @var StatoCivileSezioniCrudHandler
     */
    private $crudHandler;

    private $formSampleData, $userDetailsSample;

    protected function setUp()
    {
        parent::setUp();

        $this->crudHandler = new StatoCivileSezioniCrudHandler();

        $this->formSampleData = array(
            'id'     => '',
            'nome'   => 'Nuova sezione',
            'stato'  => '1',
        );

        $this->userDetailsSample = new \stdClass();
        $this->userDetailsSample->id = 1;
        $this->userDetailsSample->name = 'John';
        $this->userDetailsSample->surname = 'Doe';
    }
}