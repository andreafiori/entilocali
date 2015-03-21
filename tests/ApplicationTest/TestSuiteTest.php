<?php

namespace ApplicationTest;


class TestSuiteTest extends \PHPUnit_Framework_TestCase
{
    private $testSuite;

    protected function setUp()
    {
        parent::setUp();

        $this->testSuite = $this->getMockForAbstractClass('\ApplicationTest\TestSuite');
    }

    public function testGetEntityManager()
    {
        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $this->testSuite->getEntityManagerMock());
    }

    public function testGetConnection()
    {
        $this->assertInstanceOf('\Doctrine\DBAL\Connection', $this->testSuite->getConnectionMock());
    }

    public function testGetQueryBuilderMock()
    {
        $this->assertInstanceOf('\Doctrine\ORM\QueryBuilder', $this->testSuite->getQueryBuilderMock());
    }
}