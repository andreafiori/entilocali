<?php

namespace ModelModuleTest;

use Zend\ServiceManager\ServiceManager;

trait ServiceManagerProvider
{
    protected $serviceManager;

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param ServiceManager $serviceManager
     * @return $this
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }
}

class Injected
{
    use ServiceManagerProvider;
}

class TraitEntityManagerTest extends TestSuite
{
    private $injected;

    protected function setUp()
    {
        parent::setUp();

        $this->injected = new Injected();
    }

    public function testTraitInjection()
    {
        $this->injected->setServiceManager($this->serviceManager);

        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $this->injected->getServiceManager());
    }

    public function testRecoverEntityManager()
    {
        $this->injected->setServiceManager($this->serviceManager);

        $em = $this->injected->getServiceManager()->get('Doctrine\ORM\EntityManager');

        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $em);
    }
}