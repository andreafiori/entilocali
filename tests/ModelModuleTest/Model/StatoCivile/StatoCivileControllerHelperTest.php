<?php

namespace ApplicationTest\Model\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use ModelModuleTest\TestSuite;
use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;

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
            '\ModelModule\Model\StatoCivile\StatoCivileSezioniGetterWrapper',
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
