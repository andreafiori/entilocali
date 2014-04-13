<?php

namespace ApplicationTest;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use ApplicationTest\ServiceManagerGrabber;
use Application\Model\NullException;

/**
 * Help other test on this centralized test suite to set all main objects and options
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class TestSuite extends \PHPUnit_Framework_TestCase
{
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;
    protected $serviceManager;

    protected function setUp()
    {
        $serviceManagerGrabber = new ServiceManagerGrabber();
        $this->serviceManager = $serviceManagerGrabber->getServiceManager();

        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));

        $config = $this->serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();

        $this->event = new MvcEvent();
        $this->event->setRouter( HttpRouter::factory($routerConfig) );
        $this->event->setRouteMatch($this->routeMatch);
    }

    protected function getDoctrineEntityManager()
    {
        if (!$this->getServiceManager()) {
            throw new NullException('Service Manager is not set');
        }

        return $this->getServiceManager()->get('\Doctrine\ORM\EntityManager');
    }

    protected function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * "fake" test
     */
    public function testThisFile()
    {
            $this->assertTrue( true );
    }
}