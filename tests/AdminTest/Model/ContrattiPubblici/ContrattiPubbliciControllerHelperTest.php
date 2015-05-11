<?php

namespace AdminTest\Model\ContrattiPubblici;

use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use Application\Model\NullException;
use ApplicationTest\TestSuite;

class ContrattiPubbliciControllerHelper
{
    private $contrattiPubbliciGetterWrapper;

    /**
     * @param ContrattiPubbliciGetterWrapper $contrattiPubbliciGetterWrapper
     */
    public function setContrattiPubbliciGetterWrapper(ContrattiPubbliciGetterWrapper $contrattiPubbliciGetterWrapper)
    {
        $this->contrattiPubbliciGetterWrapper = $contrattiPubbliciGetterWrapper;
    }

    private function assertContrattiPubbliciGetterWrapper()
    {
        if (!$this->getContrattiPubbliciGetterWrapper()) {
            throw new NullException("ContrattiPubbliciGetterWrapper is not set");
        }
    }

    /**
     * @return ContrattiPubbliciGetterWrapper
     */
    public function getContrattiPubbliciGetterWrapper()
    {
        return $this->contrattiPubbliciGetterWrapper;
    }
}


class ContrattiPubbliciControllerHelperTest extends TestSuite
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

    public function testSetContratti()
    {
        $this->helper->setContrattiPubbliciGetterWrapper(
            new ContrattiPubbliciGetterWrapper( new ContrattiPubbliciGetter($this->getEntityManagerMock()) )
        );

        $this->assertInstanceOf(
            '\Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper',
            $this->helper->getContrattiPubbliciGetterWrapper()
        );
    }
}
