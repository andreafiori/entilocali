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

    private $classMap = array(
        'contenuti'                     => '\Application\Model\Contenuti\ContenutiHomePageBuilder',
        'albo-pretorio'                 => '\Application\Model\AlboPretorio\AlboPretorioHomePageBuilder',
        'stato-civile'                  => '\Application\Model\StatoCivile\StatoCivileHomePageBuilder',
        'amministrazione-trasparente'   => '',
        'atti-concessione'              => '\Application\Model\AttiConcessione\AttiConcessioneHomePageBuilder',
        'contratti-pubblici'            => '\Application\Model\ContrattiPubblici\ContrattiPubbliciHomePageBuilder',
        'blogs'                         => '',
        'contents'                      => '',
        'photo'                         => '',
        'freeText'                      => ''
    );

    /**
     * @param array $classMap
     */
    public function setClassMap(array $classMap)
    {
        $this->classMap = $classMap;
    }

    /**
     * @return array
     */
    public function getClassMap()
    {
        return $this->classMap;
    }

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

    /**
     * @throws NullException
     */
    private function assertHomePageRecordsGetterWrapper()
    {
        if (!$this->getHomePageRecordsGetterWrapper()) {
            throw new NullException("HomePageRecordsGetterWrapper is not set");
        }
    }

    /**
     * @param array $input
     */
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

    /**
     * @return bool
     */
    public function gatherReferenceIds()
    {
        $homePageRecords = $this->getHomePageRecords();

        if (empty($homePageRecords)) {
           return false;
        }

        foreach($homePageRecords as $key => $values) {
            foreach($values as $value) {
                if (isset($value['referenceId'])) {
                    $homePageRecords[$key]['referenceIds'][] = $value['referenceId'];
                }
            }
        }

        $this->setHomePageRecords($homePageRecords);

        return true;
    }

    public function checkHomePageRecords()
    {
        $homePageRecords = $this->getHomePageRecords();

        if (empty($homePageRecords)) {
            throw new NullException("Home page records are empty");
        }
    }

    /**
     * @param string $key
     * @throws NullException
     */
    public function checkClassMapKey($key)
    {
        if (!isset($this->classMap[$key])) {
            throw new NullException("$key does not exist on the class map");
        }
    }

    /**
     * @param string $key
     * @throws NullException
     */
    public function checkClassMapObjectExists($key)
    {
        if (!class_exists($this->classMap[$key])) {
            throw new NullException($this->classMap[$key]." object or file does not exist");
        }
    }
}
