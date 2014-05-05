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
    protected $router;
    protected $request;
    protected $routeMatch;
    protected $module;
    protected $languageAbbreviation;
    protected $channel;
    protected $isBackend;
    protected $isMultiLanguage;
    protected $appConfigs;
    protected $languageRecord;
    protected $configurations;
    
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function getQueryBuilder() {
        return $this->queryBuilder;
    }
    
}
