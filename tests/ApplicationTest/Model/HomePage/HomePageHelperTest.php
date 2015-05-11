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

    private $homePageRecordsSample;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new HomePageHelper();

        $this->homePageRecordsSample = array(
            'albo-pretorio' => array(
                array(
                    'id' => 1,
                    'referenceId' => 2,
                    'position' => 2,
                ),
                array(
                    'id' => 2,
                    'referenceId' => 3,
                    'position' => 3,
                ),
                array(
                    'id' => 3,
                    'referenceId' => 4,
                    'position' => 1,
                ),
            ),
            'freeText' => array(
                array(
                    'id' => 4,
                    'referenceId' => 5,
                    'freeText' => 'This is my free text',
                    'position' => 1,
                ),
            ),
        );
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
        $this->helper->setHomePageRecordsGetterWrapper(
            new HomePageRecordsGetterWrapper( new HomePageRecordsGetter($this->getEntityManagerMock()) )
        );
        $this->helper->setHomePageRecords($this->homePageRecordsSample);
        $this->helper->gatherReferenceIds();
    }

    public function testGatherReferenceIdsReturnFalse()
    {
        $this->helper->setHomePageRecordsGetterWrapper(
            new HomePageRecordsGetterWrapper( new HomePageRecordsGetter($this->getEntityManagerMock()) )
        );
        $this->helper->setHomePageRecords(array());

        $this->assertFalse( $this->helper->gatherReferenceIds() );
    }

    /**
     * @expectedException \Exception
     */
    public function testCheckHomePageRecordsThrowsException()
    {
        $this->helper->checkHomePageRecords();
    }

    /**
     * @expectedException \Exception
     */
    public function testCheckClassMapKey()
    {
        $this->helper->checkClassMapKey('unexistentModuleCode');
    }

    /**
     * @expectedException \Exception
     */
    public function testCheckClassMapObjectExists()
    {
        $this->helper->checkClassMapObjectExists('contenuti');
    }
}
