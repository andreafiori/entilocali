<?php

namespace ModelModuleTest\Model\AttiConcessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneControllerHelper;
use ModelModuleTest\TestSuite;

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

    public function testFormatYears()
    {
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

    public function testFormatResponsabiliForDropdown()
    {
        $this->helper->formatResponsabiliForDropdown(array(
            1 => 'Responsabile 1',
            2 => 'Responsabile 2'
        ));
    }
}
