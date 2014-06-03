<?php

namespace Application\Model\RouterManagers;

/**
 * @author Andrea Fiori
 * @since  14 May 2014
 */
class RouterManagerHelper
{
    private $routerManager;
    
    /**
     * @param \Application\Model\RouterManagers\RouterManagerAbstract $routerManager
     */
    public function __construct(RouterManagerAbstract $routerManager)
    {
       $this->routerManager = $routerManager;
    }
    
    /**
     * @return \Application\Model\RouterManagers\RouterManagerAbstract $routerManager
     */
    public function getRouterManger()
    {
        return $this->routerManager;
    }
}
