<?php

namespace AdminTest\Model;

use ApplicationTest\TestSuite;

class OperationsModelAbstractTest extends TestSuite
{
    /**
     * @var \Admin\Model\OperationsModelAbstract
     */
    private $operationsModelAbstract;

    protected function setUp()
    {
        parent::setUp();

        $this->operationsModelAbstract = $this->getMockForAbstractClass('Admin\Model\OperationsModelAbstract');
    }

    public function testSetEntityManager()
    {
        $this->operationsModelAbstract->setEntityManager($this->getEntityManagerMock());

        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $this->operationsModelAbstract->getEntityManager());
    }

    public function testSetConnection()
    {
        $this->operationsModelAbstract->setConnection($this->getConnectionMock());

        $this->assertInstanceOf('\Doctrine\DBAL\Connection', $this->operationsModelAbstract->getConnection());
    }

    /**
     * @expectedException \Exception
     */
    public function testSetupConnection()
    {
        $this->operationsModelAbstract->setupConnection();
    }
}