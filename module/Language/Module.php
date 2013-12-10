<?php

namespace Language;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

use Language\Model\Language;
use Language\Model\LanguageTable;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }
	
    public function getConfig()
	{
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Language\Model\LanguageTable' =>  function($sm) {
    						$tableGateway = $sm->get('LanguageTableGateway');
    						$table = new LanguageTable($tableGateway);
    						return $table;
    					},
    					'LanguageTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Language());
    						return new TableGateway('language', $dbAdapter, null, $resultSetPrototype);
    					},
    			),
    	);
    }
    
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
