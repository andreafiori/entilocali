<?php

namespace ModelModuleTest\Model\HomePage;

use ModelModule\Model\HomePage\HomePageHelper;
use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;
use ModelModuleTest\TestSuite;

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

    public function testSetHomePageGetterWrapper()
    {
        $this->helper->setHomePageGetterWrapper(
            new HomePageGetterWrapper( new HomePageGetter($this->getEntityManagerMock()) )
        );

        $this->assertInstanceOf(
            '\ModelModule\Model\HomePage\HomePageGetterWrapper',
            $this->helper->getHomePageGetterWrapper()
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
        $this->helper->setHomePageGetterWrapper(
            new HomePageGetterWrapper( new HomePageGetter($this->getEntityManagerMock()) )
        );

        $this->helper->setupHomePageRecords();

        $this->assertTrue( is_array($this->helper->getHomePageRecords()) );
    }

    public function testGatherReferenceIds()
    {
        $this->helper->setHomePageGetterWrapper(
            new HomePageGetterWrapper( new HomePageGetter($this->getEntityManagerMock()) )
        );
        $this->helper->setHomePageRecords($this->homePageRecordsSample);
        $this->helper->gatherReferenceIds(array(
            array(
                'id'            => 1,
                'reference_id'  => 1,
                'block_id'      => 2,
            )
        ));

        $this->assertTrue( is_array($this->helper->getHomePageRecords()) );
    }
}
