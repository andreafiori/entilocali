<?php

namespace Application\Model\FrontendHelpers;

use Application\Model\FrontendHelpers\FrontendRouterAbstract;

/**
 * Help the Index Controller to create a router object based on RouteMatchName
 * 
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class FrontendRouter extends FrontendRouterAbstract
{
    private $configurations;
    private $routeMatchName;
    private $routeMatchInstance;
    
    /**
     * @param array $configurations
     */
    public function __construct(array $configurations)
    {
        $this->configurations = $configurations;
    }
    
    /**
     * @param array $router
     */
    public function setRouteMatchName(array $router)
    {
        if ( isset($router[$this->configurations['routeMatchName']]) ) {
            $this->routeMatchName = $router[$this->configurations['routeMatchName']];
        } else {
            $this->routeMatchName = $router['default'];
        }
    }
    
    /**
     * Setup the Frontend Object to use on the index controller
     * 
     * @return \Application\Model\FrontendHelpers\FrontendRouterAbstract
     * @throws \Application\Model\NullException
     */
    public function setRouteMatchInstance()
    {
        $classPath = $this->routeMatchName;
        if ( class_exists($classPath) ) {
            $objectInstance = new $classPath();
            if ($objectInstance instanceof FrontendRouterAbstract) {
                $this->routeMatchObject = $objectInstance;
                
                return $this->routeMatchObject;
            }
        }
        
        throw new \Application\Model\NullException('RouteMatchName '.$classPath.' is not a valid class. It must be an instance of \Application\Model\FrontendHelpers\FrontendRouterInterface');
    }
}