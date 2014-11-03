<?php

namespace Application\Controller\Plugin;

use Application\Controller\Plugin\CommonSetupPluginAbstract;
use Admin\Model\Config\ConfigGetterWrapper;
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
    /**
     * Set application services and configurations
     */
    public function setApplicationServices()
    {
        $controller = $this->getController();

        $this->serviceLocator       = $controller->getServiceLocator();
        $this->serviceManager       = $this->serviceLocator->get('servicemanager');
        $this->entityManager        = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        $this->queryBuilder         = $this->entityManager->createQueryBuilder();
        $this->moduleConfigs        = $this->serviceManager->get('config');
        $this->router               = $this->serviceManager->get('router');
        $this->uri                  = $this->router->getRequestUri();
        $this->request              = $this->serviceManager->get('request');
        $this->redirect             = $controller->redirect();
        $this->flashMessenger       = $controller->flashMessenger();
        $this->routeMatch           = $this->router->match($this->request);
        $this->module               = $controller->getEvent()->getRouteMatch()->getParam('controller');
        $this->isBackend            = $this->detectIsBackend();
        $this->channel              = 1;

        $param = $controller->params();
        $this->param = array_filter( array(
            "get"    => (array) $param->fromQuery(),
            "post"   => (array) $param->fromPost(),
            "route"  => (array) $param->fromRoute(),
            "header" => (array) $param->fromHeader(),
            "files"  => (array) $param->fromFiles()
        ));

        /* App configurations from module.config */
        if ( isset($this->moduleConfigs['app_configs']) ) {
            $this->appConfigs       = $this->moduleConfigs['app_configs'];
            $this->isMultiLanguage  = isset($this->appConfigs['isMultilanguage']) ? $this->appConfigs['isMultilanguage'] : '';
        }

        $this->translator = $this->serviceLocator->get('translator');
    }
    
    /**
     * Set routMatchName on configurations record
     */
    public function setRouteMatchName()
    {
        if ( is_object($this->routeMatch) ) {
            $this->configurations['routeMatchName'] = $this->routeMatch->getMatchedRouteName();
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
     * Set main configurations given from database as variables for the layout
     * 
     * @throws \Application\Model\NullException
     */
    public function setConfigurationsVariables()
    {
        $this->setArrayAsVariables($this->configurations);
    }
    
    /**
     * Set layout variables for the view
     * 
     * @param multi $var
     */
    public function setLayoutVars($var)
    {
        $this->setArrayAsVariables($var);
    }
    
        /**
         * Set array elemens (key => value) as a var for the view
         * 
         * @param array $arrayVar
         */
        private function setArrayAsVariables(array $arrayVar)
        {
            foreach($arrayVar as $key => $value) {
                $this->getController()->layout()->setVariable($key, $value);
            }
        }

    /**
     * @return array
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
                'configurations' => $this->configurations,
                'translator'     => $this->translator,
        );
    }
        
        /**
         * @return boolean
         */
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
    public function setLanguageRecord(LanguagesSetupManager $languagesSetupManager)
    {
        $languagesSetupManager->setIsMultiLanguage(isset($this->isMultiLanguage) ? $this->isMultiLanguage : 0);
        $languagesSetupManager->setLanguageAbbreviation($this->languageAbbreviation);
        $languagesSetupManager->setLanguagesSetup( new LanguagesSetup($this->queryBuilder) );
        $languagesSetupManager->setLanguagesLabelsSetup( new LanguagesLabelsSetup($this->queryBuilder) );

        $this->languageRecord = $languagesSetupManager->generateLanguageRecord($this->channel);
    }

    /**
     * @param ConfigGetterWrapper $configGetterWrapper
     */
    public function setupConfigsFromDb(ConfigGetterWrapper $configGetterWrapper)
    {
        $configGetterWrapper->setInput(array(
            'channel'   => $this->getChannel(),
            'language'  => isset($this->languageRecord['languageId']) ? $this->languageRecord['languageId'] : 1
        ));
        $configGetterWrapper->setupQueryBuilder();
        
        $this->configurations = $configGetterWrapper->formatNameAndValue( $configGetterWrapper->getRecords() );
    }

    /**
     * Set configurations options from dbs using UserInterfaceConfigurations
     */
    public function setUserInterfaceConfigurations()
    {
        $ui = new UserInterfaceConfigurations( $this->getInput() );
        $ui->setConfigurations($this->configurations);
        $ui->setConfigurationsArray($this->isBackend);
        $ui->setCommonConfigurations();
        $ui->setPreloadResponse($this->entityManager);

        $this->configurations = array_merge($ui->getConfigurations());
    }
}