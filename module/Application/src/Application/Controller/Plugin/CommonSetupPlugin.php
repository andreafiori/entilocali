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

    private function setApplicationServices()
    {
        $this->serviceLocator       = $this->getController()->getServiceLocator();
        $this->serviceManager       = $this->serviceLocator->get('servicemanager');
        $this->entityManager        = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        $this->queryBuilder         = $this->entityManager->createQueryBuilder();
        $this->config               = $this->serviceManager->get('config');
        $this->router               = $this->serviceManager->get('router');
        $this->request              = $this->serviceManager->get('request');
        $this->routeMatch           = $this->router->match($this->request);
        $this->module               = $this->getController()->getEvent()->getRouteMatch()->getParam('controller');
        $this->languageAbbreviation = $this->getController()->params()->fromQuery('languageAbbreviation');
        $this->isBackend            = $this->detectIsBackend();
        $this->channel              = 1;
        
        if ( isset($this->config['app_configs']) ) {
            $this->appConfigs       = $this->config['app_configs'];
            $this->isMultiLanguage  = $this->appConfigs['isMultilanguage'];
        }
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
     * Set configurations using the UserInterfaceConfigurations Object
     */
    private function setUserInterfaceConfigurations()
    {
        $ui = new UserInterfaceConfigurations($this->configurations);
        $ui->setConfigurationsArray($this->isBackend);
        $ui->setCommonConfigurations();
        $ui->setPreloadResponse($this->entityManager);
        
        $this->configurations = array_merge($ui->getConfigurations());
    }
    
}