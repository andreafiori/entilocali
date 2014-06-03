<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * @author Andrea Fiori
 * @since  04 May 2014
 */
class CommonSetupPluginAbstract extends AbstractPlugin
{
    protected $serviceLocator;
    protected $serviceManager;
    protected $entityManager;
    protected $queryBuilder;
    protected $config;
    protected $configurations;
    protected $router;
    protected $uri;
    protected $request;
    protected $param;
    protected $redirect;
    protected $flashMessenger;
    protected $routeMatch;
    protected $module; 
    protected $channel;
    protected $isBackend;
    protected $appConfigs;
    protected $isMultiLanguage;
    protected $languageAbbreviation;
    protected $languageRecord;
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
    
    public function isBackend()
    {
        return $this->isBackend;
    }
}
