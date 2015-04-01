<?php

namespace Admin;

use ServiceLocatorFactory\ServiceLocatorFactory;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;
use Zend\Session\Container as SessionContainer;
use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(MvcEvent $e)
    {
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($e->getApplication()->getEventManager());

        AbstractValidator::setDefaultTranslator(
            $e->getApplication()->getServiceManager()->get('translator')
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }
    
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array( 'factories' => array() );
    }    
}
