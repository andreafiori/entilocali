<?php

namespace ApplicationTest\Controller;

use ApplicationTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;

/**
 * @author Andrea Fiori
 * @since  04 December 2013
 */
class SetupAbstractControllerTest extends TestSuite
{
    /**
     * @var \Application\Controller\SetupAbstractController
     */
    private $controller;

    protected function setUp()
    {
        parent::setUp();

        ServiceLocatorFactory::setInstance($this->getServiceManager());

        $this->controller = $this->getMockForAbstractClass('\Application\Controller\SetupAbstractController');
        $this->controller->setServiceLocator( ServiceLocatorFactory::getInstance() );
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->serviceManager);
    }

    public function testHasPasswordPreviewArea()
    {
        $this->assertFalse($this->controller->hasPasswordPreviewArea(array()));

        $this->assertTrue($this->controller->hasPasswordPreviewArea(array(
            'preview_password_area' => 'MyAreaPassword',
            'preview_password_area' =>  1
        )));
    }
}