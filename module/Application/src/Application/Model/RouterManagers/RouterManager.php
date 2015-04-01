<?php

namespace Application\Model\RouterManagers;

use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class RouterManager extends RouterManagerAbstract
{
    private $configFromDb;
    private $routeMatchName;
    private $isBackend;

    /**
     * @param array $configFromDb
     */
    public function __construct(array $configFromDb)
    {
        $this->configFromDb = $configFromDb;
    }
    
    /**
     * @param boolean $backend
     */
    public function setIsBackend($backend = null)
    {
        if (is_numeric($backend)) {
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
     * Check
     *
     * @param array $router
     * @return string
     */
    public function setRouteMatchName(array $router)
    {
        if ( isset($router[$this->configFromDb['routeMatchName']]) ) {
            $this->routeMatchName = isset($router[$this->configFromDb['routeMatchName']]) ?
            $router[$this->configFromDb['routeMatchName']] :
            null;
            
            return $this->routeMatchName;
        }
 
        if ($this->isBackend()) {
            $this->routeMatchName = isset($router['admin']) ? $router['admin'] : null;
        } else {
            $this->routeMatchName = isset($router['default']) ? $router['default'] : null;
        }
        
        return $this->routeMatchName;
    }
    
    /**
     * Setup the Frontend Object to use in the Controller
     * 
     * @return RouterManagerAbstract
     * @throws NullException
     */
    public function setupRouteMatchObjectInstance()
    {
        $classPath = $this->getRouteMatchName();
        if ( class_exists($classPath) ) {
            $objectInstance = new $classPath();
            if ($objectInstance instanceof RouterManagerAbstract) {
                return $objectInstance;
            }
        }
        
        throw new NullException('RouteMatchName '.$classPath.' is not a valid class. It must be an instance of \Application\Model\RouterManagers\RouterManagerInterface');
    }

    /**
     * @return string
     */
    public function getRouteMatchName()
    {
        return $this->routeMatchName;
    }
}
