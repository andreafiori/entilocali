<?php

namespace Application\Model;

use Admin\Service\AppServiceLoader;
use Zend\Session\Container;

class SetupAbstractControllerHelper
{
    private $adminArea;

    /**
     * @var AppServiceLoader
     */
    private $appServiceLoader;

    private $configurations;

    private $sessionContainer;

    private $frontendTemplate;

    private $frontendTemplatePath;

    private $sezioniRecords;

    private $server = null;

    /**
     * @var \Zend\Http\Request
     */
    private $request;

    private $phpRenderer = null;

    private $zf2appDir;

    private $appDirRelativePath = null;

    /**
     * @param $adminArea
     */
    public function __construct($adminArea = 0)
    {
        $this->adminArea = $adminArea;
    }

    /**
     * @param AppServiceLoader $appServiceLoader
     */
    public function setAppServiceLoader(AppServiceLoader $appServiceLoader)
    {
        $this->appServiceLoader = $appServiceLoader;
    }

    /**
     * @return \Admin\Service\AppServiceLoader
     */
    public function getAppServiceLoader()
    {
        return $this->appServiceLoader;
    }

    /**
     * @param array $configurations
     */
    public function setConfigurations($configurations)
    {
        $this->configurations = $configurations;
    }

    /**
     * @return string|null
     */
    public function getConfigurations($key = null, $noArray = null)
    {
        if (isset($this->configurations[$key])) {
            return $this->configurations[$key];
        }

        if ($noArray == null) {
            return $this->configurations;
        }
    }

    /**
     * @throws NullException
     */
    protected function assertConfigurations()
    {
        if (!$this->getConfigurations()) {
            throw new NullException("Configurations are not set");
        }
    }

    /**
     * @param Container $sessionContainer
     */
    public function setSessionContainer(Container $sessionContainer)
    {
        $this->sessionContainer = $sessionContainer;
    }

    /**
     * @return mixed
     */
    public function getSessionContainer()
    {
        return $this->sessionContainer;
    }

    public function setupFrontendTemplatePath()
    {
        $this->assertConfigurations();

        $projectFrontend = $this->getConfigurations('project_frontend');
        $templateFrontend = $this->getConfigurations('template_frontend');

        $this->frontendTemplatePath = 'frontend/projects/'.$projectFrontend.'templates/'.$templateFrontend;
    }

    /**
     * @return mixed
     */
    public function getFrontendTemplate()
    {
        return $this->frontendTemplate;
    }

    /**
     * @param \Zend\Http\Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Zend\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param array $sezioniRecords
     */
    public function setSezioniRecords($sezioniRecords)
    {
        $this->sezioniRecords = $sezioniRecords;
    }

    /**
     * @return array
     */
    public function getSezioniRecords()
    {
        return $this->sezioniRecords;
    }

    public function setupServer()
    {
        $this->assertRequest();

        $request = $this->getRequest();

        if ( method_exists($request, 'getServer') ) {
            $this->server = $request->getServer();
        }
    }

    /**
     * @return null
     */
    public function getServer()
    {
        return $this->server;
    }

    protected function assertRequest()
    {
        if (!$this->getRequest()) {
            throw new NullException("Request is not set");
        }
    }

    /**
     * @param object $serviceLocator
     */
    public function setupPhpRenderer($serviceLocator)
    {
        try {
            $this->phpRenderer = $serviceLocator->get('\Zend\View\Renderer\PhpRenderer');
        } catch(\Zend\ServiceManager\Exception\ServiceNotFoundException $e) {

        }
    }

    /**
     * @return mixed
     */
    public function getPhpRenderer()
    {
        return $this->phpRenderer;
    }

    /**
     * @throws NullException
     */
    public function assertSessionContainer()
    {
        if (!$this->getSessionContainer()) {
            throw new NullException("Session Container is not set");
        }
    }

    public function setupZf2appDir()
    {
        $this->assertConfigurations();

        $zf2appDir = $this->getConfigurations('zf2appDir');

        $this->zf2appDir = $zf2appDir;
    }

    /**
     * @return mixed
     */
    public function getZf2appDir()
    {
        return $this->zf2appDir;
    }

    /**
     * @throws NullException
     */
    public function assertZf2appDir()
    {
        if (!$this->getZf2appDir()) {
            throw new NullException("Zf2 app dire is not set");
        }
    }

    public function setupAppDirRelativePath()
    {
        $this->assertConfigurations();

        $this->assertRequest();

        $this->assertZf2appDir();

        $zf2appDir = $this->getZf2appDir();

        $isPublicDirOnRoot = $this->getConfigurations('isPublicDirOnRoot');

        if (isset($isPublicDirOnRoot)) {

            if ($isPublicDirOnRoot == 1) {
                $this->appDirRelativePath = $this->getRequest()->getBaseUrl();
            }

            $this->appDirRelativePath = str_replace($zf2appDir, '', $this->getRequest()->getBaseUrl());

        } else {
            $this->appDirRelativePath = $this->getRequest()->getBaseUrl();
        }

        if ($this->appDirRelativePath == '/') {
            $this->appDirRelativePath = null;
        }
    }

    /**
     * @return mixed
     */
    public function getAppDirRelativePath()
    {
        return $this->appDirRelativePath;
    }
}