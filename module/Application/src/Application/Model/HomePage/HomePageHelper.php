<?php

namespace Application\Model\HomePage;

use Application\Model\NullException;
use Admin\Model\HomePage\HomePageGetterWrapper;

class HomePageHelper
{
    /**
     * @var $homePageGetterWrapper
     */
    private $homePageGetterWrapper;

    private $homePageRecords;

    private $issetReferenceIds;

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
        'freeText'                      => '\Application\Model\HomePage\FreeTextHomePageBuilder'
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
     * @param $key
     * @return mixed
     */
    public function recoverClassMapKey($key)
    {
        if (isset($this->classMap[$key])) {
            return $this->classMap[$key];
        }

        return null;
    }

    /**
     * @param HomePageGetterWrapper $homePageGetterWrapper
     */
    public function setHomePageGetterWrapper(HomePageGetterWrapper $homePageGetterWrapper)
    {
        $this->homePageGetterWrapper = $homePageGetterWrapper;
    }

    /**
     * @return \Admin\Model\HomePage\HomePageGetterWrapper $homePageGetterWrapper
     */
    public function getHomePageGetterWrapper()
    {
        return $this->homePageGetterWrapper;
    }

    /**
     * @throws NullException
     */
    private function assertHomePageGetterWrapper()
    {
        if (!$this->getHomePageGetterWrapper()) {
            throw new NullException("HomePageGetterWrapper is not set");
        }
    }

    /**
     * @param array $input
     */
    public function setupHomePageRecords($input = array())
    {
        $this->assertHomePageGetterWrapper();

        $wrapper = $this->getHomePageGetterWrapper();
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $this->setHomePageRecords(
            $wrapper->formatPerModuleCode($wrapper->getRecords())
        );
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
     * Attach referenceIDs into the existing home page recordset
     */
    public function gatherReferenceIds()
    {
        $this->assertHomePageRecords();

        $homePageRecords = $this->getHomePageRecords();
        foreach($homePageRecords as $key => $values) {
            foreach($values as $value) {
                if (isset($value['referenceId'])) {
                    $homePageRecords[$key]['referenceIds'][] = $value['referenceId'];
                }
            }
        }

        $this->issetReferenceIds = 1;

        $this->setHomePageRecords($homePageRecords);
    }

    /**
     * @throws NullException
     */
    private function assertHomePageRecords()
    {
        if (!$this->getHomePageRecords()) {
            throw new NullException("HomePageRecords are not set");
        }
    }

    /**
     * @throws NullException
     */
    private function assertIssetReferenceIds()
    {
        if (!$this->issetReferenceIds) {
            throw new NullException("Reference IDs are not set");
        }
    }

    /**
     * @throws NullException
     */
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

    /**
     * @throws NullException
     */
    public function checkClassMapFromRecords()
    {
        $this->assertIssetReferenceIds();

        $records = $this->getHomePageRecords();
        foreach($records as $key => $value) {
            $this->checkClassMapKey($key);
            $this->checkClassMapObjectExists($key);
        }
    }
}
