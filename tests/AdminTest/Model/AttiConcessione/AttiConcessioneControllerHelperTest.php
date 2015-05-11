<?php

namespace AdminTest\Model\AttiConcessione;

use Admin\Model\AttiConcessione\AttiConcessioneControllerHelper;
use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;
use ApplicationTest\TestSuite;

class AttiConcessioneControllerHelperTest extends TestSuite
{
    /**
     * @var AttiConcessioneControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new AttiConcessioneControllerHelper();
    }

    public function testSetAttiConcessioneGetterWrapper()
    {
        $this->setAttiConcessioneGetterWrapper();

        $this->assertInstanceOf(
            '\Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper',
            $this->helper->getAttiConcessioneGetterWrapper()
        );
    }

    /**
     * @expectedException \Exception
     */
    public function testSetupAttiConcessioneGetterWrapperWithPaginatorThrowsException()
    {
        $this->helper->setupAttiConcessioneGetterWrapperWithPaginator(array(), 1, 8);
    }

    public function testSetupAttiConcessioneGetterWrapperWithPaginator()
    {
        $this->setAttiConcessioneGetterWrapper();

        $this->helper->setupAttiConcessioneGetterWrapperWithPaginator(array(), 1, 8);

        $this->assertInstanceOf(
            '\Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper',
            $this->helper->getAttiConcessioneGetterWrapper()
        );
        $this->assertTrue( is_object($this->helper->getAttiConcessioneGetterWrapper()->getPaginator()) );
    }

    public function testSetupYearsRecords()
    {
        $this->setAttiConcessioneGetterWrapper();

        $this->helper->setupYearsRecords();

        $this->assertTrue( is_array($this->helper->getYearsRecords()) );
    }

    public function testFormatYears()
    {
        $this->setAttiConcessioneGetterWrapper();

        $formattedYears = $this->helper->formatYears(array(
            array(
                'year' => 2014,
            ),
            array(
                'year' => 2015,
            )
        ));

        $this->assertArrayHasKey(2015, $formattedYears);
    }

    public function testSetUsersSettoriGetterWrapper()
    {
        $this->helper->setUsersSettoriGetterWrapper(
            new UsersSettoriGetterWrapper(new UsersSettoriGetter($this->getEntityManagerMock()))
        );

        $this->assertInstanceOf(
            '\Admin\Model\Users\Settori\UsersSettoriGetterWrapper',
            $this->helper->getUsersSettoriGetterWrapper()
        );
    }

    /**
     * @expectedException \Exception
     */
    public function testSetupSettoriRecordsThrowsException()
    {
        $this->helper->setupSettoriRecords(array());
    }

    public function testSetupSettoriRecords()
    {
        $this->helper->setUsersSettoriGetterWrapper(
            new UsersSettoriGetterWrapper(new UsersSettoriGetter($this->getEntityManagerMock()))
        );
        $this->helper->setupSettoriRecords(array());

        $this->assertTrue( is_array($this->helper->getUsersSettoriRecords()) );
    }

        private function setAttiConcessioneGetterWrapper()
        {
            $this->helper->setAttiConcessioneGetterWrapper(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($this->getEntityManagerMock()))
            );
        }
}
