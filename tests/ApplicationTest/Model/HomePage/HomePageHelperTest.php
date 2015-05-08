<?php

namespace ApplicationTest\Model\HomePage;

use Application\Model\HomePage\HomePageHelper;
use Application\Model\HomePage\HomePageRecordsGetter;
use Application\Model\HomePage\HomePageRecordsGetterWrapper;
use ApplicationTest\TestSuite;

class HomePageHelperTest extends TestSuite
{
    /**
     * @var HomePageHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new HomePageHelper();
    }

    public function testSetHomePageRecordsGetterWrapper()
    {
        $this->helper->setHomePageRecordsGetterWrapper(
            new HomePageRecordsGetterWrapper( new HomePageRecordsGetter($this->getEntityManagerMock()) )
        );

        $this->assertInstanceOf(
            '\Application\Model\HomePage\HomePageRecordsGetterWrapper',
            $this->helper->getHomePageRecordsGetterWrapper()
        );
    }

    /**
     * @expectedException \Exception
     */
    public function testSetupHomePageRecordsThrowsException()
    {
        $this->helper->setupHomePageRecords();
    }

    public function testSetupHomePageRecords()
    {
        $this->helper->setHomePageRecordsGetterWrapper(
            new HomePageRecordsGetterWrapper( new HomePageRecordsGetter($this->getEntityManagerMock()) )
        );

        $this->helper->setupHomePageRecords();

        $this->assertTrue( is_array($this->helper->getHomePageRecords()) );
    }

    public function testGatherReferenceIds()
    {
        $recordTest = array(
            'albo-pretorio' => array(
                array(
                    'id' => 1,
                    'referenceId' => 2,
                ),
                array(
                    'id' => 2,
                    'referenceId' => 3,
                ),
                array(
                    'id' => 3,
                    'referenceId' => 4,
                ),
            ),
            'freeText' => array(
                array(
                    'id' => 4,
                    'referenceId' => 5,
                    'freeText' => 'This is my free text'
                ),
            ),
        );

        $this->helper->setHomePageRecordsGetterWrapper(
            new HomePageRecordsGetterWrapper( new HomePageRecordsGetter($this->getEntityManagerMock()) )
        );
        $this->helper->setHomePageRecords($recordTest);
        $this->helper->gatherReferenceIds();
    }
}
