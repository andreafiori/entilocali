<?php

namespace AdminTest\Model\Contenuti;

use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Contenuti\HomePagePutRemoveControllerHelper;
use ApplicationTest\TestSuite;

class HomePagePutRemoveControllerHelperTest extends TestSuite
{
    /**
     * @var HomePagePutRemoveControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new HomePagePutRemoveControllerHelper();
    }

    public function testSetContenutiGetterWrapper()
    {
        $this->helper->setContenutiGetterWrapper(
            new ContenutiGetterWrapper( new ContenutiGetter($this->getEntityManagerMock()) )
        );

        $this->assertInstanceOf(
            '\Admin\Model\Contenuti\ContenutiGetterWrapper',
            $this->helper->getContenutiGetterWrapper()
        );
    }

    public function testSetupContenutiRecords()
    {
        $this->helper->setContenutiGetterWrapper(
            new ContenutiGetterWrapper( new ContenutiGetter($this->getEntityManagerMock()) )
        );

        $this->helper->setupContenutiRecords(array());

        $this->assertTrue( is_array($this->helper->getContenutiRecords()) );
    }
}
