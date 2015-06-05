<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModuleTest\TestSuite;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;

class StatoCivileControllerHelperTest //extends TestSuite
{
    /**
     * @var StatoCivileControllerHelper
     */
    private $statoCivileControllerHelper;

    protected function setUp()
    {
        parent::setUp();

        $this->statoCivileControllerHelper = new StatoCivileControllerHelper();
    }
}
