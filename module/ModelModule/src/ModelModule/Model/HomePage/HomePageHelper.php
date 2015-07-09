<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\NullException;

class HomePageHelper extends ControllerHelperAbstract
{
    /**
     * @var $homePageGetterWrapper
     */
    private $homePageGetterWrapper;

    private $homePageRecords;

    private $issetReferenceIds;

    private $classMap = array(
        'contenuti'                     => '\ModelModule\Model\Contenuti\ContenutiHomePageBuilder',
        'amministrazione-trasparente'   => '\ModelModule\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteHomePageBuilder',
        'albo-pretorio'                 => '\ModelModule\Model\AlboPretorio\AlboPretorioHomePageBuilder',
        'stato-civile'                  => '\ModelModule\Model\StatoCivile\StatoCivileHomePageBuilder',
        'atti-concessione'              => '\ModelModule\Model\AttiConcessione\AttiConcessioneHomePageBuilder',
        'contratti-pubblici'            => '\ModelModule\Model\ContrattiPubblici\ContrattiPubbliciHomePageBuilder',
        'blogs'                         => '\ModelModule\Model\Blogs\BlogsHomePageBuilder',
        'photo'                         => '\ModelModule\Model\Photo\PhotoHomePageBuilder',
        'freeText'                      => '\ModelModule\Model\HomePage\FreeTextHomePageBuilder'
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
     * @param string $key
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
     * @return \ModelModule\Model\HomePage\HomePageGetterWrapper $homePageGetterWrapper
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
     *
     * @return \ModelModule\Model\QueryBuilderHelperAbstract
     */
    public function setupHomePageRecords($input = array())
    {
        $this->assertHomePageGetterWrapper();

        $wrapper = $this->getHomePageGetterWrapper();
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $homePageRecords = $wrapper->getRecords();
        if (!empty($homePageRecords)) {
            $this->setHomePageRecords( $wrapper->formatPerModuleCode($homePageRecords) );
        }

        return $homePageRecords;
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
     *
     * @param array $homePageRecords
     * @return mixed
     */
    public function gatherReferenceIds($homePageRecords)
    {
        if (!empty($homePageRecords)) {

            foreach($homePageRecords as $key => $values) {
                foreach($values as $value) {
                    if (isset($value['referenceId'])) {
                        $homePageRecords[$key]['referenceIds'][] = $value['referenceId'];
                    }
                }
            }

            $this->issetReferenceIds = 1;
        }

        return $homePageRecords;
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
     * Check if the module code exists into the class ma
     *
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
    public function checkClassMapFromRecords($records)
    {
        $this->assertIssetReferenceIds();

        if (!empty($records)) {
            foreach($records as $key => $value) {
                $this->checkClassMapKey($key);
                $this->checkClassMapObjectExists($key);
            }
        }
    }
}
