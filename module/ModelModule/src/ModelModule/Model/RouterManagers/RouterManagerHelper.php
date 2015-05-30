<?php

namespace ModelModule\Model\RouterManagers;

class RouterManagerHelper
{
    private $routerManager;
    
    /**
     * @param RouterManagerAbstract $routerManager
     */
    public function __construct(RouterManagerAbstract $routerManager)
    {
       $this->routerManager = $routerManager;
    }
    
    /**
     * @return RouterManagerAbstract $routerManager
     */
    public function getRouterManger()
    {
        return $this->routerManager;
    }
}