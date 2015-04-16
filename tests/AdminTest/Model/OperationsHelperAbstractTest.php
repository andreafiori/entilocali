<?php

namespace Admin\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  14 April 2015
 */
class OperationsHelperAbstractTest extends TestSuite
{
    private $operationsHelperAbstract;

    protected function setUp()
    {
        parent::setUp();

        $this->operationsHelperAbstract = $this->getMockForAbstractClass('Admin\Model\OperationsHelperAbstract');
    }

    public function testSetConnection()
    {
        $this->operationsHelperAbstract->setConnection($this->getConnectionMock());

        $this->assertInstanceOf('\Doctrine\DBAL\Connection', $this->operationsHelperAbstract->getConnection());
    }
}