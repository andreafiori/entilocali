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
    protected $translator;
    protected $router;
    protected $uri;
    protected $request;
    protected $param;
    protected $redirect;
    protected $flashMessenger;
    protected $routeMatch;
    protected $module;
    protected $moduleRecord;
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
    
    public function getConfig()
    {
        return $this->config;
    }

    public function getConfigurations()
    {
        return $this->configurations;
    }

    public function getTranslator()
    {
        return $this->translator;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

    public function getFlashMessenger()
    {
        return $this->flashMessenger;
    }

    public function getRouteMatch()
    {
        return $this->routeMatch;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getModuleRecord() {
        return $this->moduleRecord;
    }

    public function getChannel() {
        return $this->channel;
    }

    public function getIsBackend() {
        return $this->isBackend;
    }

    public function getAppConfigs() {
        return $this->appConfigs;
    }

    public function getIsMultiLanguage()
    {
        return $this->isMultiLanguage;
    }

    public function getLanguageAbbreviation()
    {
        return $this->languageAbbreviation;
    }

    public function getLanguageRecord()
    {
        return $this->languageRecord;
    }
}
