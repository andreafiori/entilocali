<?php

namespace Application\Controller;

use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;
use ModelModule\Model\SetupAbstractControllerHelper;
use ModelModule\Setup\UserInterfaceConfigurations;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Service\AppServiceLoader;
use ModelModule\Model\Config\ConfigGetter;
use ModelModule\Model\Config\ConfigGetterWrapper;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container as SessionContainer;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

abstract class SetupAbstractController extends AbstractActionController
{
    const formTemplate = 'formdata/formdata.phtml';

    const summaryTemplate = 'datatable/datatable.phtml';

    /**
     * @var ViewModel
     */
    protected $viewModel;

    /**
     * @param int $channel
     * @return string
     */
    protected function initializeAdminArea($channel = 1)
    {
        $appServiceLoader = $this->recoverAppServiceLoader($channel);

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            header("Location: ".$this->url()->fromRoute('password-preview'));
            exit;
        }

        $request            = $this->getRequest();
        $uri                = $request->getUri();
        $basePath           = sprintf('%s://%s%s', $uri->getScheme(), $uri->getHost(), $request->getBaseUrl().'/');
        $cookieWarning      = $sessionContainer->offsetGet($configurations['sitename']);

        $helper = new SetupAbstractControllerHelper();
        $helper->setConfigurations($configurations);
        $helper->setRequest($request);
        $helper->setupZf2appDir();
        $helper->setupAppDirRelativePath();

        $templateBackend = $configurations['template_backend'];

        $this->layout()->setVariables(array_merge(
            $configurations,
            array(
                'configurations'                => $configurations,
                'publicDirRelativePath'         => $helper->getAppDirRelativePath().'/public',
                'baseUrl'                       => sprintf($basePath.'admin/main/'.$this->params()->fromRoute('lang').'/'),
                'basePath'                      => $basePath,
                'userDetails'                   => $sessionContainer->offsetGet('userDetails'),
                'preloadResponse'               => $helper->getConfigurations('preloadResponse', 1),
                'templateDir'                   => 'backend/templates/'.$templateBackend,
                'formDataCommonPath'            => 'backend/templates/common/',
                'passwordPreviewArea'           => $this->hasPasswordPreviewArea($configurations),
                'cookieWarning'                 => !empty($cookieWarning) ? $cookieWarning : null,
                'isMultiLanguage'               => isset($configurations['isMultiLanguage']) ? 1 : 0,
                'defaultLanguageId'             => 1,
                'defaultLanguageAbbreviation'   => 'it',
            )
        ));

        return 'backend/templates/'.$templateBackend.'backend.phtml';
    }

    /**
     * Initialize variables for the public website
     *
     * @return string
     */
    protected function initializeFrontendWebsite($channel = 1)
    {
        $appServiceLoader = $this->recoverAppServiceLoader($channel);

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            header("Location: ".$this->url()->fromRoute('password-preview'));
            exit;
        }

        $serviceLocator = $this->getServiceLocator();
        $request = $this->getRequest();
        $uri = $request->getUri();
        $cookieWarningSession = $sessionContainer->offsetGet('cookie-warning');
        $lang = $this->params()->fromRoute('lang');

        $helper = new SetupAbstractControllerHelper();
        $helper->setConfigurations($configurations);
        $helper->setRequest($request);
        $helper->setSezioniGetterWrapper( new SezioniGetterWrapper(
            new SezioniGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default')))
        );
        $helper->setupSezioniRecords(array(
            'attivo'                => 1,
            'languageAbbreviation'  => isset($lang) ? $lang : 'it',
            'orderBy'               => 'sezioni.posizione ASC',
        ));

        $sottosezioniRecords = $helper->getSezioniGetterWrapper()->addSottoSezioni(
            $helper->getSezioniRecords(),
            array('attivo' => 1)
        );

        $helper->setSezioniRecords( $helper->getSezioniGetterWrapper()->formatRecordsPerColumn($sottosezioniRecords) );
        $helper->setupServer();
        $helper->setupFrontendTemplatePath();
        $helper->setupPhpRenderer( $this->getServiceLocator() );
        $helper->setupZf2appDir();
        $helper->setupAppDirRelativePath();

        $serverVars = $helper->getServer();

        /**
         * @var \Zend\Mvc\I18n\Translator $translator
         */
        $translator = $serviceLocator->get('translator');
        if ( file_exists('./module/Application/language/app.'.$lang.'.php') ) {
            $translator->addTranslationFile('phparray', './module/Application/language/app.'.$lang.'.php');
        }
        if ( file_exists('./module/Application/language/form.array.'.$lang.'.php') ) {
            $translator->addTranslationFile('phparray', './module/Application/language/form.array.'.$lang.'.php');
        }
        $serviceLocator->get('ViewHelperManager')->get('translate')->setTranslator($translator);

        $this->layout()->setVariables($configurations);
        $this->layout()->setVariables( array(
            'basePath'                      => sprintf('%s://%s%s', $uri->getScheme(), $uri->getHost(), $request->getBaseUrl().'/'),
            'publicDirRelativePath'         => $helper->getAppDirRelativePath().'/public',
            'configurations'                => $configurations,
            'sezioni'                       => $helper->getSezioniRecords(),
            'templateDir'                   => 'frontend/projects/'.$configurations['project_frontend'].'templates/'.$configurations['template_frontend'],
            'preloadResponse'               => isset($input['preloadResponse']) ? $input['preloadResponse'] : null,
            'currentUrl'                    => "http://".$serverVars["SERVER_NAME"].$serverVars["REQUEST_URI"],
            'currentDateTime'               => date("Y-m-d H:i:s"),
            'template_frontend'             => $configurations['template_frontend'],
            'cssName'                       => $sessionContainer->offSetGet('cssName'),
            'passwordPreviewArea'           => $this->hasPasswordPreviewArea($configurations),
            'renderer'                      => $helper->getPhpRenderer(),
            'cookieWarning'                 => isset($cookieWarningSession[$configurations['sitename']]) ? $cookieWarningSession[$configurations['sitename']] : null,
            'lang'                          => (isset($lang)) ? $lang : 'it',
            'isMultiLanguage'               => isset($configurations['isMultiLanguage']) ? 1 : 0,
            'defaultLanguageId'             => 1,
            'defaultLanguageAbbreviation'   => 'it',
        ));

        return 'frontend/projects/'.$configurations['project_frontend'].'templates/'.$configurations['template_frontend'] .'layout.phtml';
    }

    /**
     * @return \ModelModule\Service\AppServiceLoader
     */
    protected function recoverAppServiceLoader($channel = 1)
    {
        $sl = $this->getServiceLocator();
        $em = $sl->get('Doctrine\ORM\EntityManager');
        $sm = $sl->get('servicemanager');

        $appServiceLoader = new AppServiceLoader();

        $appServiceLoader->setProperties(array(
                'serviceLocator'    => $sl,
                'serviceManager'    => $sm,
                'entityManager'     => $em,
                'queryBuilder'      => $em->createQueryBuilder(),
                'translator'        => $sm->get('translator'),
                'moduleConfigs'     => $sm->get('config'),
                'request'           => $sm->get('request'),
                'router'            => $sm->get('request'),
            )
        );

        $appServiceLoader->recoverRouter();
        $appServiceLoader->recoverRouteMatch();
        $appServiceLoader->setService('channel', $channel);
        $appServiceLoader->setController($this);
        $appServiceLoader->setupParams();
        $appServiceLoader->setupRedirect();
        $appServiceLoader->setupConfigurations(new ConfigGetterWrapper(new ConfigGetter($em)), array());
        $appServiceLoader->setupUserInterfaceConfigurations(
            new UserInterfaceConfigurations($appServiceLoader->recoverService('configurations'))
        );
        return $appServiceLoader;
    }

    /**
     * Check parameters for the password preview area
     *
     * @param array $configurations
     * @param SessionContainer $sessionContainer
     *
     * @return bool
     */
    public function checkPasswordPreviewArea(array $configurations, SessionContainer $sessionContainer)
    {
        if (!$this->hasPasswordPreviewArea($configurations)) {
            return true;
        }

        if ( isset($configurations['preview_password_area']) and $sessionContainer->offsetGet('preview_area_ok')!=1) {
            return false;
        }

        $dateDiff = date_diff(
            date_create($sessionContainer->offsetGet('preview_area_logintimeout')),
            date_create(date("Y-m-d H:i:s"))
        );

        if ($dateDiff->i > 60) {
            $sessionContainer->offsetUnset('preview_area_ok');
            $sessionContainer->offsetUnset('preview_area_logintimeout');
            return false;
        }

        return true;
    }

    /**
     * Check if the password preview area is activated
     *
     * @param array $configurations
     * @return bool
     */
    public function hasPasswordPreviewArea(array $configurations)
    {
        if ( isset($configurations['preview_password_area']) and $configurations['preview_password_area']==1) {
            return true;
        }

        return false;
    }

    /**
     * @return \stdClass
     */
    protected function recoverUserDetails()
    {
        $session = new SessionContainer();

        return $session->offsetGet('userDetails');
    }

    /**
     * @return mixed
     */
    protected function recoverAcl()
    {
        $session = new SessionContainer();

        return $session->offsetGet('userDetails')->acl;
    }

    /**
     * @param array $logArray
     * @return bool
     */
    protected function log(array $logArray)
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $log = new LogWriter($em->getConnection());

        return $log->writeLog($logArray);
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    protected function recoverConnection()
    {
        return $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection();
    }

    /**
     * @return Response
     */
    protected function redirectForUnvalidAccess()
    {
        if (is_object( $this->getRequest()->getHeader('Referer'))) {
            return $this->redirect()->toUrl(
                $this->getRequest()->getHeader('Referer')->uri()->getPath()
            );
        }

        return $this->redirect()->toRoute('main', array('lang' => 'it') );
    }
}
