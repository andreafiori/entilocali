<?php

namespace Application\Controller\Plugin;

use Application\Controller\Plugin\CommonSetupPluginAbstract;
use Application\Setup\ConfigSetup;
use Application\Setup\LanguagesSetupManager;
use Application\Setup\LanguagesSetup;
use Application\Setup\LanguagesLabelsSetup;
use Application\Setup\UserInterfaceConfigurations;

/**
 * Plugin to iniatialize services and get the main configurations record
 * 
 * @author Andrea Fiori
 * @since  28 April 2014
 */
class CommonSetupPlugin extends CommonSetupPluginAbstract
{
    public function recoverConfigurationsRecord()
    {
        $this->setApplicationServices();
        $this->setLanguageRecord( new LanguagesSetupManager() );
        $this->initializeConfigurations( new ConfigSetup($this->queryBuilder) );
        $this->setRouteMatchName();
        $this->setUserInterfaceConfigurations();
        
        return $this->configurations;
    }
    
    /**
     * Set routMatchName on configurations record
     */
    public function setRouteMatchName()
    {
        if ( is_object($this->routeMatch) ) {
            $this->configurations['routeMatchName'] = $this->routeMatch->getMatchedRouteName();
        } else {
            $this->configurations['routeMatchName'] = '';
        }
    }

    /**
     * @param array $input
     * @return array
     */
    public function mergeInput(array $input)
    {
        return array_merge($this->getInput(), $input);
    }
    
    /**
     * @throws \Application\Model\NullException
     */
    public function setConfigurationsVariables()
    {
        $this->setArrayAsVariables($this->configurations);
    }
    
    public function setLayoutVars($var)
    {
        $this->setArrayAsVariables($var);
    }
    
        private function setArrayAsVariables($arrayVar)
        {
            if ( !is_array($arrayVar) ) {
                throw new \Application\Model\NullException("Array Must Be passed to setArrayAsVariables on CommonSetupPlugin");
            }

            foreach($arrayVar as $key => $value) {
                $this->getController()->layout()->setVariable($key, $value);
            }
        }

        private function setApplicationServices()
        {
            $controller = $this->getController();
            $param = $controller->params();
            
            $this->serviceLocator       = $controller->getServiceLocator();
            $this->serviceManager       = $this->serviceLocator->get('servicemanager');
            $this->entityManager        = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
            $this->queryBuilder         = $this->entityManager->createQueryBuilder();
            $this->config               = $this->serviceManager->get('config');
            $this->router               = $this->serviceManager->get('router');
            $this->uri                  = $this->router->getRequestUri();
            $this->request              = $this->serviceManager->get('request');
            $this->redirect             = $controller->redirect();
            $this->flashMessenger       = $controller->flashMessenger();
            $this->param = array_filter( array(
                "get"    => (array) $param->fromQuery(),
                "post"   => (array) $param->fromPost(),
                "route"  => (array) $param->fromRoute(),
                "header" => (array) $param->fromHeader(),
                "files"  => (array) $param->fromFiles()
            ));
            $this->routeMatch           = $this->router->match($this->request);
            $this->module               = $controller->getEvent()->getRouteMatch()->getParam('controller');
            $this->isBackend            = $this->detectIsBackend();
            $this->channel              = 1;

            if ( isset($this->config['app_configs']) ) {
                $this->appConfigs       = $this->config['app_configs'];
                $this->isMultiLanguage  = $this->appConfigs['isMultilanguage'];
            }
            
            if ($this->isBackend) {
                $this->moduleRecord = array(
                    1  => 'Blogs',
                    4  => 'Contenuti',
                    6  => 'Foto',
                );
            }
        }

        /**
         * @return type
         */
        public function getInput()
        {
            return array(
                    'serviceLocator' => $this->serviceLocator,
                    'serviceManager' => $this->serviceManager,
                    'entityManager'  => $this->entityManager,
                    'queryBuilder'   => $this->queryBuilder,
                    'moduleRecord'   => $this->moduleRecord,
                    'redirect'       => $this->redirect,
                    'request'        => $this->request,
                    'param'          => $this->param,
                    'uri'            => $this->uri,
                    'flashMessenger' => $this->flashMessenger,
            );
        }

        private function detectIsBackend()
        {
            if ($this->module == 'Application\Controller\Index') {
                return false;
            } elseif ($this->module == 'Admin\Controller\Admin') {
                return true;
            }
        }

        /**
         * @param \Application\Setup\LanguagesSetupManager $languagesSetupManager
         */
        private function setLanguageRecord(LanguagesSetupManager $languagesSetupManager)
        {
            $languagesSetupManager->setIsMultiLanguage(isset($this->isMultiLanguage) ? $this->isMultiLanguage : 0);
            $languagesSetupManager->setLanguageAbbreviation($this->languageAbbreviation);
            $languagesSetupManager->setLanguagesSetup( new LanguagesSetup($this->queryBuilder) );
            $languagesSetupManager->setLanguagesLabelsSetup( new LanguagesLabelsSetup($this->queryBuilder) );

            $this->languageRecord = $languagesSetupManager->generateLanguageRecord($this->channel);
        }

        /**
         * @param \Application\Setup\ConfigSetup $configSetup
         */
        private function initializeConfigurations(ConfigSetup $configSetup)
        {
            $this->configurations = array_merge(
                    $configSetup->setConfigurations($this->channel, $this->languageRecord['languageId']),
                    $this->languageRecord
            );
        }

        /**
         * Set configurations using the UserInterfaceConfigurations Object
         */
        private function setUserInterfaceConfigurations()
        {
            $ui = new UserInterfaceConfigurations($this->configurations);
            $ui->setConfigurationsArray($this->isBackend);
            $ui->setModules();
            $ui->setCommonConfigurations();
            $ui->setPreloadResponse($this->entityManager);

            $this->configurations = array_merge($ui->getConfigurations());
        }
    
}