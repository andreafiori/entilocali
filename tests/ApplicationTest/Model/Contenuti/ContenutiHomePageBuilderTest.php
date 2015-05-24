<?php

namespace ApplicationTest\Model\Contenuti;

use Application\Model\Contenuti\ContenutiHomePageBuilder;
use ApplicationTest\TestSuite;

class ContenutiHomePageBuilderTest extends TestSuite
{
    /**
     * @var ContenutiHomePageBuilder
     */
    private $builder;

    protected function setUp()
    {
        parent::setUp();

        $this->builder = new ContenutiHomePageBuilder();
    }

    public function testRecoverHomePageElements()
    {
        $this->builder->setEntityManager($this->getEntityManagerMock());
        $this->builder->setModuleRelatedRecords(array(
            array(
                array(
                    'id' => 1,
                    'titolo' => 'My Title'
                ),
            ),
            'referenceIds' => array(1, 2, 3)
        ));

        $this->assertInstanceOf('Zend\Paginator\Paginator', $this->builder->recoverHomePageElements());
    }
}
