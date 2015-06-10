<?php

namespace ModelModuleTest\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModuleTest\TestSuite;

class ContrattiPubbliciControllerHelperTest //extends TestSuite
{
    /**
     * @var ContrattiPubbliciControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new ContrattiPubbliciControllerHelper();
    }

}