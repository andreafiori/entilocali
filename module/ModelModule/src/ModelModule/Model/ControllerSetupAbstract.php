<?php

namespace ModelModule\Model;

use ModelModule\Model\RouterManagers\RouterManager;
use ModelModule\Model\RouterManagers\RouterManagerHelper;

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
     * @return RouterManager
     */
    public function setRouterManager(RouterManager $routerManager)
    {
        $this->routerManager = $routerManager;

        return $this->routerManager;
    }

    /**
     * @param RouterManagerHelper $routerManagerHelper
     * @return RouterManagerHelper
     */
    public function setRouterManagerHelper(RouterManagerHelper $routerManagerHelper)
    {
        $this->routerManagerHelper = $routerManagerHelper;

        return $this->routerManagerHelper;
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