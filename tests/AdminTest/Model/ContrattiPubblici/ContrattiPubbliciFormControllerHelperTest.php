<?php

namespace AdminTest\Model\ContrattiPubblici;

use Admin\Model\ContrattiPubblici\ContrattiPubbliciFormControllerHelper;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;
use ApplicationTest\TestSuite;

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
            '\Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper',
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

    public function setUsersRespProcGetterWrapper()
    {

    }

        private function setupSceltaContraenteGetterWrapper()
        {
            $this->helper->setSceltaContraenteGetterWrapper(
                new SceltaContraenteGetterWrapper(new SceltaContraenteGetter($this->getEntityManagerMock()))
            );
        }
}