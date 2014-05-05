<?php

namespace ApplicationTest\Model;

use ApplicationTest\TestSuite;

/**
 * Set and get Service Manager properties
 * 
 * @author Andrea Fiori
 * @since  23 April 2014
 */
class ServiceManagerSetterGetter
{
    protected $serviceManager;
    protected $config;
    protected $router;
    protected $routeRequest;
    protected $routeMatch;
    protected $routeMatchName;
    
    /**
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(\Zend\ServiceManager\ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        /*
        $this->config         = $this->serviceManager->get('config');
        $this->router         = $this->serviceManager->get('router');
        $this->routeRequest   = $this->serviceManager->get('request');
        $this->routeMatch     = $this->router->match($this->routeRequest);
        
        if ( is_object($this->routeMatch) ) {
            $this->routeMatchName = $this->routeMatch->getMatchedRouteName();
        }
        */
    }
    
    public function setConfig($config) {
        $this->config = $config;
    }

    public function setRouter($router) {
        $this->router = $router;
    }

    public function setRouteRequest($routeRequest) {
        $this->routeRequest = $routeRequest;
    }

    public function setRouteMatch($routeMatch) {
        $this->routeMatch = $routeMatch;
    }

    public function setRouteMatchName($routeMatchName) {
        $this->routeMatchName = $routeMatchName;
    }
    
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getRouteRequest()
    {
        return $this->routeRequest;
    }

    public function getRouteMatch()
    {
        return $this->routeMatch;
    }

    public function getRouteMatchName()
    {
        return $this->routeMatchName;
    }
    
}

/**
 * @author Andrea Fiori
 * @since  23 April 2014
 */
class ServiceManagerSetterGetterTest extends TestSuite
{
    private $serviceManagerSetterGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->serviceManagerSetterGetter = new ServiceManagerSetterGetter( $this->getServiceManager() );
    }
    
    /**
     * TODO: specify object types on a assertInstanceOf
     */
    public function testGetVarsAfterConstructorInjection()
    {
        $this->assertNotEmpty( $this->serviceManagerSetterGetter->getServiceManager() );
        /*
        $this->assertNotEmpty( $this->serviceManagerSetterGetter->getConfig() );
        $this->assertNotEmpty( $this->serviceManagerSetterGetter->getRouter() );
        $this->assertNotEmpty( $this->serviceManagerSetterGetter->getRouteRequest() );
        $this->assertEmpty( $this->serviceManagerSetterGetter->getRouteMatch() );
        $this->assertEmpty( $this->serviceManagerSetterGetter->getRouteMatchName() );
        */
    }
}