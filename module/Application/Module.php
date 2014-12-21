<?php

namespace Application;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Application\View\Helper\TextShortener;
use Admin\Service\AppServiceLoader;

class Module implements AutoloaderProviderInterface
{
    /**
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
    	$application = $e->getApplication();
        $sm          = $application->getServiceManager();
        
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach( $application->getEventManager() );
        
        try {
            $dbInstance = $sm->get('Zend\Db\Adapter\Adapter');
            $dbInstance->getDriver()->getConnection()->connect();
        } catch (\Exception $ex) {
            $viewModel = $e->getViewModel();
            $viewModel->setTemplate('layout/layout');
 
            $content = new \Zend\View\Model\ViewModel();
            $content->setTemplate('error/dbconnection');

            $viewModel->setVariable('content', $sm->get('ViewRenderer')
                                                  ->render($content));

            exit( $sm->get('ViewRenderer')->render($viewModel) );
        }
        
        $em = $application->getEventManager();
        $em->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'handleError'));
        $em->attach(\Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR, array($this, 'handleError'));
    }

    /**
     * Handle errors exceptions and controller not found
     * 
     * @param MvcEvent $e
     */
    public function handleError(MvcEvent $e)
    {

    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    /**
     * Configure plain text and custom form elements
     * @return multitype:multitype:string
     */
    public function getViewHelperConfig()
    {
        return array(
            'invokables' 	=> array(
                'formelement'   => 'Application\Form\View\Helper\FormElement',
                'formPlainText' => 'Application\Form\View\Helper\FormPlainText',
                'formCheckboxTree' => 'Application\Form\View\Helper\FormCheckboxTree',
            ),
            'factories' => array(
                'TextShortener' => function($sm) {
                    return new TextShortener();
                },
                'Params' => function($sl) {
                    $app = $sl->getServiceLocator()->get('Application');
                    return new View\Helper\Params($app->getRequest(), $app->getMvcEvent());
                },
            ),
        );
    }

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
     * Share authentication for both frontend and backend
     * 
     * @return AuthService object
     */
    public function getServiceConfig()
    {
    	return array(
            'factories' => array(
		'Admin\Model\MyAuthStorage' => function() {
		    return new \Admin\Model\MyAuthStorage('login');
		},
		'AuthService' => function($sm) {
		    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter, 'zfcms_users', 'username', 'password', 'MD5(?)');
		    
		    $authService = new AuthenticationService();
		    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('Admin\Model\MyAuthStorage'));
                    
		    return $authService;
		},
                'AppServiceLoader' => function($sl) {
                    $appServiceLoader = new AppServiceLoader();
                    
                    $em = $sl->get('Doctrine\ORM\EntityManager');
                    $sm = $sl->get('servicemanager');
		    $appServiceLoader->setProperties( array(
                        'serviceLocator'    => $sl,
                        'serviceManager'    => $sm,
                        'entityManager'     => $em,
                        'queryBuilder'      => $em->createQueryBuilder(),
                        'translator'        => $sm->get('translator'),
                        'moduleConfigs'     => $sm->get('config'),
                        'request'           => $sm->get('request'),
                        'router'            => $sm->get('request'),
                    ));
                    
                    $appServiceLoader->recoverRouter();
                    $appServiceLoader->recoverRouteMatch();
                    
                    return $appServiceLoader;
		},
            ),
        );
    }
}