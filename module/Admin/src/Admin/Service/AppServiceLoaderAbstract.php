<?php

namespace Admin\Service;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Mvc\Router\RouteMatch;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * @author Andrea Fiori
 * @since  26 November 2014
 */
abstract class AppServiceLoaderAbstract
{
    protected $controller;
    protected $properties = array();
    
    /**
     * @param string $key
     * @param string $value
     */
    public function setService($key, $value)
    {
        $this->properties[$key] = $value;
    }
    
    /**
     * @param string $key
     * @return mixed
     */
    public function recoverService($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param string $value
     * @return null
     */
    public function recoverServiceKey($key, $value)
    {
        if (isset($this->properties[$key][$value])) {
            return $this->properties[$key][$value];
        }

        return null;
    }
    
    /**
     * @param array $properties
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;        
    }
    
    public function getProperties()
    {
        if (!empty($this->properties)) {
            return $this->properties;
        }
    }
    
    /**
     * @param object $controller
     * @return object
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        
        return $this->controller;
    }

    /**
     * @return object
     */
    public function getController()
    {
        return $this->controller;
    }

        protected function assertController()
        {
            if ( !$this->getController() ) {
                throw new \Exception("Controller is not set");
            }
        }

    /**
     * @return mixed
     */
    public function recoverRouter()
    {
        try {
            $this->setService('router', $this->recoverService('serviceManager')->get('router') );
        } catch(ServiceNotCreatedException $ex) {
            $this->setService('router', HttpRouter::factory(array()) );
        }
        
        return $this->recoverService('router');
    }

    /**
     * @return RouteMatch
     */
    public function recoverRouteMatch()
    {
        try {
            $this->setService('routeMatch', $this->recoverService('router')->match($this->recoverService('request')) );
        } catch(ServiceNotCreatedException $ex) {
            $this->setService('routeMatch', new RouteMatch(array('controller' => 'index')) );
        }
        
        if (!$this->recoverService('routeMatch')) {
            $this->setService('routeMatch', new RouteMatch(array('controller' => 'index')) );
        }
        
        return $this->recoverService('routeMatch');
    }
}
