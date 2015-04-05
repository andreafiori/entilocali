<?php

namespace Application;

use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Application\View\Helper\TextShortener;
use Admin\Service\AppServiceLoader;

/**
 * Appliacation Module
 */
class Module implements AutoloaderProviderInterface
{
    /**
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
    	$application = $e->getApplication();
        $sm          = $application->getServiceManager();

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

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
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    /**
     * Configure plain text and custom form elements
     *
     * @return multitype:multitype:string
     */
    public function getViewHelperConfig()
    {
        return array(
            'invokables' 	=> array(
                'formelement'       => 'Application\Form\View\Helper\FormElement',
                'formPlainText'     => 'Application\Form\View\Helper\FormPlainText',
                'formCheckboxTree'  => 'Application\Form\View\Helper\FormCheckboxTree',
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

    /**
     * @return array
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
    public function getServiceConfig()
    {
    	return array(
            'factories' => array(
                'MyAuthStorage' => function() {
                    return new \Admin\Model\MyAuthStorage('login');
                },
                'AuthService' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter  = new AuthAdapter($dbAdapter, 'zfcms_users', 'username', 'password', 'MD5(CONCAT(?, salt))');

                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('MyAuthStorage'));

                    return $authService;
                },
                'SezioniRecords' => function($sl) {
                    $em = $sl->get('Doctrine\ORM\EntityManager');

                    $wrapper = new SezioniGetterWrapper(new SezioniGetter($em));
                    $wrapper->setInput(array(
                        'orderBy'   => 'sezioni.posizione ASC',
                        'attivo'    => 1,
                    ));
                    $wrapper->setupQueryBuilder();

                    return $wrapper->formatRecordsPerColumn(
                        $wrapper->addSottoSezioni($wrapper->getRecords(), array('attivo'=>1))
                    );
                },
            ),
        );
    }
}