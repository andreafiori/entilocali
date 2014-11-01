<?php

namespace Application\Model\RouterManagers;

use Application\Model\RouterManagers\RouterManagerAbstract;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class RouterManager extends RouterManagerAbstract
{
    private $configurations;
    private $routeMatchName;
    private $routeMatchObjectInstance;
    private $isBackend;

    /**
     * @param array $configurations
     */
    public function __construct(array $configurations)
    {
        $this->configurations = $configurations;
    }
    
    /**
     * @param boolean $backend
     */
    public function setIsBackend($backend = null)
    {
        if ($backend) {
            $this->isBackend = $backend;
        }
    }
     
    /**
     * @return string
     */   
    public function isBackend()
    {
        return $this->isBackend;
    }
    
    /**
     * Given the module configurations, 
     * 
     * @param array $router
     */
    public function setRouteMatchName(array $router)
    {
        if ( isset($router[$this->configurations['routeMatchName']]) ) {
            $this->routeMatchName = $router[$this->configurations['routeMatchName']];
            
            return $this->routeMatchName;
        }
        
        if ( $this->isBackend() ) {
            $this->routeMatchName = isset($router['admin']) ? $router['admin'] : null;
        } else {
            $this->routeMatchName = isset($router['default']) ? $router['default'] : null;
        }
        
        return $this->routeMatchName;
    }
    
    /**
     * Setup the Frontend Object to use on the index controller
     * 
     * @return \Application\Model\RouterManagers\RouterManagerAbstract
     * @throws \Application\Model\NullException
     */
    public function setupRouteMatchObjectInstance()
    {
        $classPath = $this->routeMatchName;
        if ( class_exists($classPath) ) {
            $objectInstance = new $classPath();
            if ($objectInstance instanceof RouterManagerAbstract) {
                return $objectInstance;
            }
        }
        
        throw new \Application\Model\NullException('RouteMatchName '.$classPath.' is not a valid class. It must be an instance of \Application\Model\RouterManagers\RouterManagerInterface');
    }
    
    /**
     * @return string
     */
    public function getRouteMatchName()
    {
        return $this->routeMatchName;
    }
}