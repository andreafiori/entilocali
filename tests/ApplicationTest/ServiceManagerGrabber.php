<?php

namespace ApplicationTest;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;

/**
 * Load Main Services
 * 
 * @author Andrea Fiori
 * @since  24 January 2014
 */
class ServiceManagerGrabber
{
	protected static $serviceConfig = null;

    /**
     * @param $config
     */
    public static function setServiceConfig($config)
    {
        static::$serviceConfig = $config;
    }

    /**
     * @return null
     */
    public static function getServiceConfig()
    {
    	return static::$serviceConfig;
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
    	$configuration = static::$serviceConfig ? : require_once './config/application.config.php';

        $smConfig = isset($configuration['service_manager']) ? $configuration['service_manager'] : array();
        $serviceManager = new ServiceManager(new ServiceManagerConfig($smConfig));
        $serviceManager->setService('ApplicationConfig', $configuration);
        $serviceManager->get('ModuleManager')->loadModules();
        
        return $serviceManager;
    }
}