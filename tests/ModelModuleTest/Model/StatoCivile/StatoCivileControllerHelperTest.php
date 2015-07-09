<?php

namespace ModelModuleTest\Model\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use ModelModuleTest\TestSuite;

class StatoCivileControllerHelperTest extends TestSuite
{
    /**
     * @var StatoCivileControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new StatoCivileControllerHelper();
    }

    public function testRecoverNumeroProgressivo()
    {
        $progressivo = $this->helper->recoverNumeroProgressivo(
            new StatoCivileGetterWrapper(new StatoCivileGetter($this->getEntityManagerMock()))
        );

        $this->assertEquals($progressivo, 1);
    }
}
