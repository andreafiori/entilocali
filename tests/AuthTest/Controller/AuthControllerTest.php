<?php

namespace AuthTest\Controller;

use ModelModuleTest\TestSuite;
use Auth\Controller\AuthController;
use Zend\Http\PhpEnvironment\Request;
use Zend\Server\Method\Parameter;
use Zend\Stdlib\Parameters;

/**
 * @author Andrea Fiori
 * @since  05 December 2013
 */
class AuthControllerTest extends TestSuite
{
    /**
     * @var AuthController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AuthController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());
    }
    
    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');

        $this->controller->dispatch($this->request);

        $this->assertEquals(200, $this->controller->getResponse()->getStatusCode());
    }

    public function testAutenticateActionReturnsRedirect()
    {
        $this->routeMatch->setParam('action', 'authenticate');

        $this->controller->dispatch($this->request);

        $this->assertEquals(302, $this->controller->getResponse()->getStatusCode());
    }

    /*
    public function testAutenticateAction()
    {
        $this->routeMatch->setParam('action', 'authenticate');

        $request = new Request();
        $request->setMethod('POST');
        $request->setPost(new Parameters(array('username' => 'myUser', 'password' => 'MySecretPassword')));

        $this->controller->dispatch($request);

        $this->assertEquals(202, $this->controller->getResponse()->getStatusCode());
    }
    */
}
