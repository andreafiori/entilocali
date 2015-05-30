<?php

namespace ModelModuleTest\Model\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormControllerHelper;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;
use ModelModuleTest\TestSuite;

class ContrattiPubbliciFormControllerHelperTest extends TestSuite
{
    /**
     * @var ContrattiPubbliciFormControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new ContrattiPubbliciFormControllerHelper();
    }

    public function testSetSceltaContraenteGetterWrapper()
    {
        $this->setupSceltaContraenteGetterWrapper();

        $this->assertInstanceOf(
            '\ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper',
            $this->helper->getSceltaContraenteGetterWrapper()
        );
    }

    public function testSetupSceltaContraenteRecords()
    {
        $this->setupSceltaContraenteGetterWrapper();

        $this->helper->setupSceltaContraenteRecords(array());

        $this->assertTrue( is_array($this->helper->getSceltaContraenteRecords()) );
    }

    public function testFormatSceltaContraenteRecords()
    {
        $this->setupSceltaContraenteGetterWrapper();

        $this->helper->setupSceltaContraenteRecords(array());
        $this->helper->formatSceltaContraenteRecords();

        $this->assertTrue( is_array($this->helper->getSceltaContraenteRecords()) );
    }

        private function setupSceltaContraenteGetterWrapper()
        {
            $this->helper->setSceltaContraenteGetterWrapper(
                new SceltaContraenteGetterWrapper(new SceltaContraenteGetter($this->getEntityManagerMock()))
            );
        }
}