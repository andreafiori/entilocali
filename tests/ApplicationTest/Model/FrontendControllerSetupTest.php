<?php

namespace ApplicationTest\Model;

use ApplicationTest\TestSuite;
use Application\Model\FrontendControllerSetup;
use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  04 March 2015
 */
class FrontendControllerSetupTest extends TestSuite
{
    private $frontendControllerSetup;

    private $sezioniGetterWrapper;

    protected function setUp()
    {
        parent::setUp();

        $this->frontendControllerSetup = new FrontendControllerSetup();
    }

    public function testSetupSezioniGetterWrapper()
    {
        $this->setupSezioniGetterWrapperInstance();

        $this->assertInstanceOf('\Admin\Model\Sezioni\SezioniGetterWrapper', $this->sezioniGetterWrapper);
    }

    public function testSetupSottoSezioniRecords()
    {
        $this->setupSezioniGetterWrapperInstance();

        $this->frontendControllerSetup->setupSottoSezioniRecords( array() );
    }

    public function testSortByColumn()
    {
        $this->assertEmpty(array());

        $this->assertNotEmpty(
            $this->frontendControllerSetup->sortByColumn(array(
                array(
                    'nome'      => 'Sezione 1',
                    'colonna'   => 'sx'
                ),
                array(
                    'nome'      => 'Sezione 2',
                    'colonna'   => 'sx'
                ),
                array(
                    'nome'      => 'Sezione 3',
                    'colonna'   => 'dx'
                ),
                array(
                    'nome'      => 'Sezione 4',
                    'colonna'   => 'dx'
                ),
            ))
        );
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetupSezioniRecordsThrowsNullException()
    {
        $this->frontendControllerSetup->setupSezioniRecords();
    }

    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetupSottoSezioniRecordsThrowsNullException()
    {
        $this->frontendControllerSetup->setupSottoSezioniRecords(array());
    }

    public function testSetupSezioniRecords()
    {
        $this->setupSezioniGetterWrapperInstance();

        $this->assertTrue( is_array($this->frontendControllerSetup->setupSezioniRecords()) );
    }

        private function setupSezioniGetterWrapperInstance()
        {
            $this->sezioniGetterWrapper = $this->frontendControllerSetup->setupSezioniGetterWrapper(
                new SezioniGetterWrapper(
                    new SezioniGetter($this->getEntityManagerMock())
                )
            );
        }
}