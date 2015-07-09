<?php

namespace Application\Fixture;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service;

/**
 * Recover services (EntityManager) from ServiceManger loading application configurations
 */
abstract class FixtureServiceAbstract
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var ServiceManager
     */
    private $sm;

    public function __construct()
    {
        $this->config = include('config/application.config.php');

        $this->sm = new ServiceManager(new Service\ServiceManagerConfig($this->config));
        $this->sm->setService('ApplicationConfig', $this->config);
        $this->sm->get('ModuleManager')->loadModules();
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function recoverEntityManager()
    {
        return $this->sm->get('doctrine.entitymanager.orm_default');
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function recoverConnection()
    {
        $em = $this->recoverEntityManager();

        return $em->getConnection();
    }
}