<?php

namespace AdminTest\Model\Contenuti;

use Admin\Model\Contenuti\ContenutiControllerHelper;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use ApplicationTest\TestSuite;

class ContenutiControllerHelperTest extends TestSuite
{
    /**
     * @var ContenutiControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new ContenutiControllerHelper();
    }

    public function testSetContenutiGetterWrapper()
    {
        $this->helper->setContenutiGetterWrapper(
            new ContenutiGetterWrapper(
                new ContenutiGetter($this->getEntityManagerMock())
            )
        );

        $this->assertInstanceOf(
            '\Admin\Model\Contenuti\ContenutiGetterWrapper',
            $this->helper->getContenutiGetterWrapper()
        );
    }

    public function testSetupContenutiGetterWrapperRecords()
    {
        $this->helper->setContenutiGetterWrapper( new ContenutiGetterWrapper(
                new ContenutiGetter($this->getEntityManagerMock())
            )
        );

        $this->helper->setupContenutiGetterWrapperRecords( array() );

        $this->assertTrue( is_array($this->helper->getContenutiGetterWrapperRecords()) );
    }

    public function testSetSottoSezioniGetterWrapper()
    {
        $this->helper->setSottoSezioniGetterWrapper(
            new SottoSezioniGetterWrapper(
                new SottoSezioniGetter($this->getEntityManagerMock())
            )
        );

        $this->assertInstanceOf(
            '\Admin\Model\Sezioni\SottoSezioniGetterWrapper',
            $this->helper->getSottoSezioniGetterWrapper()
        );
    }

    public function testSetupSottoSezioniGetterWrapperRecords()
    {
        $this->helper->setSottoSezioniGetterWrapper(
            new SottoSezioniGetterWrapper(
                new SottoSezioniGetter($this->getEntityManagerMock())
            )
        );

        $this->helper->setupSottoSezioniGetterWrapperRecords( array() );

        $this->assertTrue( is_array($this->helper->getSottoSezioniGetterWrapperRecords()) );
    }

    public function testFormatSottoSezioniGetterWrapperRecords()
    {
        $this->helper->setSottoSezioniGetterWrapper(
            new SottoSezioniGetterWrapper(
                new SottoSezioniGetter($this->getEntityManagerMock())
            )
        );

        $this->helper->setupSottoSezioniGetterWrapperRecords(array());

        $this->helper->formatSottoSezioniGetterWrapperRecordsForDropdown(array(
            array(
                'idSottoSezione'    => 'Sottosezione 1',
                'nomeSezione'       => 'Sezione 1',
                'nomeSottoSezione'  => 'nomeSottoSezione',
            ),
            array(
                'idSottoSezione'    => 'Sottosezione 2',
                'nomeSezione'       => 'Sezione 2',
                'nomeSottoSezione'  => 'nomeSottoSezione',
            ),
        ));

        $this->assertTrue( is_array($this->helper->getSottoSezioniGetterWrapperRecords()) );
    }

    /**
     * @expectedException \Exception
     */
    public function testFormatSottoSezioniGetterWrapperRecordsForDropdownThrowsException()
    {
        $this->helper->formatSottoSezioniGetterWrapperRecordsForDropdown();
    }

    /**
     * @expectedException \Exception
     */
    public function testSetupConteutiGetterWrapperRecordsThrowsExpception()
    {
        $this->helper->setupContenutiGetterWrapperRecords();
    }

    /**
     * @expectedException \Exception
     */
    public function testSetupSottoSezioniGetterWrapperRecordsThrowsExpception()
    {
        $this->helper->setupSottoSezioniGetterWrapperRecords();
    }

    public function testSetupContenutiGetterWrapperRecordsPaginator()
    {
        $this->helper->setContenutiGetterWrapper(
            new ContenutiGetterWrapper(
                new ContenutiGetter($this->getEntityManagerMock())
            )
        );

        $this->helper->setupContenutiGetterWrapperRecordsPaginator(
            array(),
            0
        );
    }
}
