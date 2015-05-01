<?php

namespace ApplicationTest\Model\StatoCivile;

use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use ApplicationTest\TestSuite;
use Application\Model\StatoCivile\StatoCivileControllerHelper;

/**
 * @author Andrea Fiori
 * @since  18 April 2015
 */
class StatoCivileControllerHelperTest extends TestSuite
{
    /**
     * @var StatoCivileControllerHelper
     */
    private $statoCivileControllerHelper;

    protected function setUp()
    {
        parent::setUp();

        $this->statoCivileControllerHelper = new StatoCivileControllerHelper();
    }

    public function testSetStatoCivileSezioniGetterWrapper()
    {
        $this->statoCivileControllerHelper->setStatoCivileSezioniGetterWrapper(
            new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($this->getEntityManagerMock()) )
        );

        $this->assertInstanceOf(
            '\Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper',
            $this->statoCivileControllerHelper->getStatoCivileSezioniGetterWrapper()
        );
    }

    public function testFormatSezioniForFormSelect()
    {
        $records = $this->statoCivileControllerHelper->formatSezioniForFormSelect(array(
                array('id' => 1, 'nome' => 'Nome Sezione'),
            )
        );

        $this->assertTrue( is_array($records) );
    }

    public function testFormatSezioniForFormSelectIsFalse()
    {
        $this->assertFalse( $this->statoCivileControllerHelper->formatSezioniForFormSelect(array()) );
    }

    public function testSetupSezioniRecords()
    {
        $this->statoCivileControllerHelper->setStatoCivileSezioniGetterWrapper(
            new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($this->getEntityManagerMock()) )
        );

        $this->assertTrue( is_array( $this->statoCivileControllerHelper->setupSezioniRecords(array()) ) );
    }
}
