<?php

namespace ModelModuleTest\Model\Contenuti;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModuleTest\TestSuite;

class ContenutiControllerHelperTest // extends TestSuite
{
    /**
     * @var ContenutiControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new ContenutiControllerHelper();
    }

    public function testInsert()
    {

    }
}
