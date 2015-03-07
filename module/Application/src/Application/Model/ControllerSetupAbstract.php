<?php

namespace Application\Model;

use Application\Model\RouterManagers\RouterManager;
use Application\Model\RouterManagers\RouterManagerHelper;

/**
 * @author Andrea Fiori
 * @since  04 March 2015
 */
abstract class ControllerSetupAbstract
{
    protected $routerManager;

    protected $routerManagerHelper;

    /**
     * @param RouterManager $routerManager
     */
    public function setRouterManager(RouterManager $routerManager)
    {
        $this->routerManager = $routerManager;
    }

    /**
     * @param mixed $routerManagerHelper
     */
    public function setRouterManagerHelper($routerManagerHelper)
    {
        $this->routerManagerHelper = $routerManagerHelper;
    }

    /**
     * @return RouterManager
     */
    public function getRouterManager()
    {
        return $this->routerManager;
    }

    /**
     * @return mixed
     */
    public function getRouterManagerHelper()
    {
        return $this->routerManagerHelper;
    }
}