<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\NullException;

class HomePageControllerHelper
{
    private $homePageBlocksGetterWrapper;

    private $homePageBlocksRecords;

    /**
     * @param HomePageBlocksGetterWrapper $wrapper
     */
    public function setHomePageBlocksGetterWrapper(HomePageBlocksGetterWrapper $wrapper)
    {
        $this->homePageBlocksGetterWrapper = $wrapper;
    }

    private function assertHomePageBlocksGetterWrapper()
    {
        if (!$this->getHomePageBlocksGetterWrapper()) {
            throw new NullException("HomePageBlocksGetterWrapper is not set");
        }
    }

    /**
     * @return HomePageBlocksGetterWrapper
     */
    public function getHomePageBlocksGetterWrapper()
    {
        return $this->homePageBlocksGetterWrapper;
    }

    /**
     * @param array $input
     */
    public function setupHomePageBlocksRecords($input = array())
    {
        $this->assertHomePageBlocksGetterWrapper();

        $wrapper = $this->getHomePageBlocksGetterWrapper();
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $this->homePageBlocksRecords = $wrapper->getRecords();
    }

    /**
     * @return mixed
     */
    public function getHomePageBlocksRecords()
    {
        return $this->homePageBlocksRecords;
    }
}