<?php

namespace ModelModule\Service;

use ModelModule\Model\NullException;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Mvc\Router\RouteMatch;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\ServiceManager;

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

        return $this->properties;
    }

    /**
     * @return array|null
     */
    public function getProperties()
    {
        if (!empty($this->properties)) {
            return $this->properties;
        }

        return null;
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
     * @return \Zend\Mvc\Controller\AbstractController
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
        $this->assertServiceManager();

        try {
            $this->setService('router', $this->recoverService('serviceManager')->get('router') );
        } catch(ServiceNotCreatedException $ex) {
            $this->setService('router', HttpRouter::factory(array()) );
        }

        return $this->recoverService('router');
    }

        /**
         * @throws NullException
         */
        private function assertServiceManager()
        {
            if (!$this->recoverService('serviceManager') instanceof ServiceManager) {
                throw new NullException("Service Manager is not set as a service");
            }
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
