<?php

namespace Application\Model\HomePage;

use Application\Model\NullException;

class HomePageHelper
{
    /**
     * @var HomePageRecordsGetterWrapper
     */
    private $homePageRecordsGetterWrapper;

    private $homePageRecords;

    /**
     * @param HomePageRecordsGetterWrapper $homePageRecordsGetterWrapper
     */
    public function setHomePageRecordsGetterWrapper($homePageRecordsGetterWrapper)
    {
        $this->homePageRecordsGetterWrapper = $homePageRecordsGetterWrapper;
    }

    /**
     * @return HomePageRecordsGetterWrapper
     */
    public function getHomePageRecordsGetterWrapper()
    {
        return $this->homePageRecordsGetterWrapper;
    }

    private function assertHomePageRecordsGetterWrapper()
    {
        if (!$this->getHomePageRecordsGetterWrapper()) {
            throw new NullException("HomePageRecordsGetterWrapper is not set");
        }
    }

    public function setupHomePageRecords($input = array())
    {
        $this->assertHomePageRecordsGetterWrapper();

        $wrapper = $this->getHomePageRecordsGetterWrapper();
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $this->setHomePageRecords($wrapper->formatPerModuleCode($wrapper->getRecords()));
    }

    /**
     * @param array $homePageRecords
     */
    public function setHomePageRecords($homePageRecords)
    {
        $this->homePageRecords = $homePageRecords;
    }

    /**
     * @return array
     */
    public function getHomePageRecords()
    {
        return $this->homePageRecords;
    }

    public function gatherReferenceIds()
    {
        $homePageRecords = $this->getHomePageRecords();

        if (empty($homePageRecords)) {
           return false;
        }

        foreach($homePageRecords as $key => $values) {
            foreach($values as $value) {
                $homePageRecords[$key]['referenceIds'][] = $value['referenceId'];
            }
        }

        $this->setHomePageRecords($homePageRecords);
    }
}