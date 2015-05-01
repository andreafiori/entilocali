<?php

namespace Application\Controller;

use Application\Setup\UserInterfaceConfigurations;
use Admin\Model\Logs\LogsWriter;
use Admin\Service\AppServiceLoader;
use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container as SessionContainer;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * @author Andrea Fiori
 * @since  04 December 2013
 */
abstract class SetupAbstractController extends AbstractActionController
{
    const formTemplate = 'formdata/formdata.phtml';

    const summaryTemplate = 'datatable/datatable.phtml';

    /**
     * @var ViewModel
     */
    protected $viewModel;

    protected function initializeAdminArea($channel = 1)
    {
        $appServiceLoader = $this->recoverAppServiceLoader($channel);

        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            header("Location: ".$this->url()->fromRoute('password-preview'));
            exit;
        }

        $templateBackend = $appServiceLoader->recoverServiceKey('configurations', 'template_backend');

        $uri            = $this->getRequest()->getUri();
        $basePath       = sprintf('%s://%s%s', $uri->getScheme(), $uri->getHost(), $this->getRequest()->getBaseUrl().'/');
        $templateDir    = 'backend/templates/'.$templateBackend;

        $this->layout()->setVariables( array_merge(
            $configurations,
            array(
                'baseUrl'               => sprintf($basePath.'admin/main/'.$this->params()->fromRoute('lang').'/'),
                'basePath'              => $basePath,
                'userDetails'           => $sessionContainer->offsetGet('userDetails'),
                'preloadResponse'       => $appServiceLoader->recoverServiceKey('configurations', 'preloadResponse'),
                'templateBackendDir'    => $templateDir,
                'templatePartial'       => $templateDir.'datatable/datatable.phtml',
                'formDataCommonPath'    => 'backend/templates/common/',
                'passwordPreviewArea'   => $this->hasPasswordPreviewArea($configurations),
            )
        ));

        return 'backend/templates/'.$templateBackend.'backend.phtml';
    }

    protected function initializeFrontendWebsite()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();
        $configurations = $appServiceLoader->recoverService('configurations');

        $sessionContainer = new SessionContainer();

        if (!$this->checkPasswordPreviewArea($configurations, $sessionContainer)) {
            header("Location: ".$this->url()->fromRoute('password-preview'));
            exit;
        }

        $sezioni = $this->getServiceLocator()->get('SezioniRecords');

        if (method_exists($this->getRequest(), 'getServer')) {
            $serverVars = $this->getRequest()->getServer();
        } else $serverVars = null;

        $templateDir = 'frontend/projects/'.$configurations['project_frontend'].'templates/'.$configurations['template_frontend'];
        if (isset($varsFromModel['basiclayout'])) {
            $basicLayout = $templateDir.$varsFromModel['basiclayout'];
        } else {
            $basicLayout = $templateDir.'/layout.phtml';
        }

        try {
            $phpRenderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        } catch(\Zend\ServiceManager\Exception\ServiceNotFoundException $e) {
            $phpRenderer = null;
        }

        $this->layout()->setVariables($configurations);

        $this->layout()->setVariables( array(
            'sezioni'               => $sezioni,
            'templateDir'           => $templateDir,
            'preloadResponse'       => isset($input['preloadResponse']) ? $input['preloadResponse'] : null,
            'currentUrl'            => "http://".$serverVars["SERVER_NAME"].$serverVars["REQUEST_URI"],
            'currentDateTime'       => date("Y-m-d H:i:s"),
            'template_frontend'     => $configurations['template_frontend'],
            'cssName'               => $sessionContainer->offSetGet('cssName'),
            'passwordPreviewArea'   => $this->hasPasswordPreviewArea($configurations),
            'renderer'              => $phpRenderer,
        ));

        return $basicLayout;
    }

    /**
     * @return \Admin\Service\AppServiceLoader
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
        $appServiceLoader->setupConfigurations( new ConfigGetterWrapper(new ConfigGetter($em)) );
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

        $log = new LogsWriter($em->getConnection());

        return $log->writeLog($logArray);
    }
}
