<?php

namespace ModelModuleTest\Model\Contenuti;

use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Contenuti\HomePagePutRemoveControllerHelper;
use ModelModuleTest\TestSuite;

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
            '\ModelModule\Model\Contenuti\ContenutiGetterWrapper',
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
