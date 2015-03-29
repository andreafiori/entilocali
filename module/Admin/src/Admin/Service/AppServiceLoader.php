<?php

namespace Admin\Service;

use Admin\Model\Config\ConfigGetterWrapper;
use Admin\Model\Modules\ModulesGetterWrapper;
use Application\Setup\UserInterfaceConfigurations;

/**
 * @author Andrea Fiori
 * @since  26 November 2014
 */
class AppServiceLoader extends AppServiceLoaderAbstract
{
    /**
     * @throws \Exception
     */
    public function setupUri()
    {
        $router = $this->recoverService('router');
        
        if ( !is_object($router) ) {
            throw new \Exception("Router service is not set or it's not an object");
        }
        
        if ( method_exists($router, 'getRequestUri') ) {
            $this->setService('uri', $router->getRequestUri());
        }
    }

    public function setupRedirect()
    {
        $this->assertController();
        
        $this->setService('redirect', $this->getController()->redirect());
    }

    /**
     * Setup Flash Messenger object
     */
    public function setupFlashMessenger()
    {
        $this->assertController();
        
        $this->setService('flashMessenger', $this->getController()->flashMessenger());
    }

    /**
     * Setup current Zend Module Name
     */
    public function setupCurrentModuleName()
    {
        $this->assertController();
        
        $this->setService('module', $this->getController()->getEvent()->getRouteMatch()->getParam('controller'));
    }
    
    /**
     * @param string $currentModuleName
     */
    public function setupIsBackend($currentModuleName = null)
    {
        if (!$currentModuleName) {
            $currentModuleName = $this->recoverService('module');
        }
        
        if ($currentModuleName == 'Application\Controller\Index') {
            $this->setService('isBackend', false);
        } elseif ($currentModuleName == 'Admin\Controller\Admin') {
            $this->setService('isBackend', true);
        }
    }

    public function setupParams()
    {
        $this->assertController();
        
        $this->setService('param', array_filter( array(
                "get"    => (array) $this->getController()->params()->fromQuery(),
                "post"   => (array) $this->getController()->params()->fromPost(),
                "route"  => (array) $this->getController()->params()->fromRoute(),
                "header" => (array) $this->getController()->params()->fromHeader(),
                "files"  => (array) $this->getController()->params()->fromFiles()
                )
            )
        );       
    }
    
    /**
     * Select configurations from database
     *
     * @param ConfigGetterWrapper $configGetterWrapper
     * @param number $channel
     * @param number $languageId
     */
    public function setupConfigurations(ConfigGetterWrapper $wrapper, $channel = 1, $languageId = 1)
    {
        if (!is_object($this->recoverService('routeMatch'))) {
            throw new \Exception("RouteMatch is not set");
        }

        $wrapper->setInput(array(
            'channel'   => $channel,
            'language'  => $languageId,
            'isBackend' => $this->recoverService('isBackend')
        ));
        $wrapper->setupQueryBuilder();

        $configurations = $wrapper->formatNameAndValue( $wrapper->getRecords() );

        $configurations['routeMatchName'] = $this->recoverService('routeMatch')->getMatchedRouteName();

        $this->setService('configurations', $configurations);

        return $configurations;
    }

    /**
     * @param ModulesGetterWrapper $wrapper
     * @param array $input
     * @return \Application\Model\QueryBuilderHelperAbstract
     */
    public function setupModules(ModulesGetterWrapper $wrapper, $input = array())
    {
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $records = $wrapper->getRecords();

        $this->setService('modules', $records);

        return $records;
    }

    /**
     * @param UserInterfaceConfigurations $ui
     * @return UserInterfaceConfigurations
     */
    public function setupUserInterfaceConfigurations(UserInterfaceConfigurations $ui)
    {
        //$ui->setConfigurations($this->recoverService('configurations'));
        if ($this->recoverService('isBackend')) {
            $ui->setAdditionalAdminConfigurationsArray();
        } else {
            $ui->setAdditionalFrontendConfigurationsArray();
        }
        //$ui->setCommonConfigurations();
        $ui->setPreloadResponse($this->recoverService('entityManager'));
        
        return $ui;
    }
}