<?php

namespace ApplicationTest\Fixture;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service;
use ModelModuleTest\TestSuite;

class FixtureServiceAbstractTest extends TestSuite
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testGetEntityManagerFromServiceManager()
    {
        $config = include('config/application.config.php');

        $sm = new ServiceManager(new Service\ServiceManagerConfig($config));
        $sm->setService('ApplicationConfig', $config);
        $sm->get('ModuleManager')->loadModules();

        $zendConfig = $sm->get('config');

        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $sm->get('doctrine.entitymanager.orm_default'));
    }
}
