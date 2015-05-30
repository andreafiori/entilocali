<?php

namespace ApplicationTest\Model;

use ModelModuleTest\TestSuite;
use ModelModule\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  09 April 2015
 */
class NullExceptionTest extends TestSuite
{
    /**
     * @var NullException
     */
    private $nullException;

    protected function setUp()
    {
        parent::setUp();

        $this->nullException = new NullException();
    }

    public function testSetParams()
    {
        $this->nullException->setParams(array(
            'myParam' => 'paramValue'
        ));

        $this->assertArrayHasKey('myParam',  $this->nullException->getParams());
    }
}