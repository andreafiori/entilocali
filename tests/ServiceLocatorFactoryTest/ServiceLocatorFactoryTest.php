<?php

namespace ServiceLocatorFactoryTest;

use ModelModuleTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;
use Zend\ServiceManager\ServiceManager;

/**
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class ServiceLocatorFactoryTest extends TestSuite
{
    public function testSetinstance()
    {
        ServiceLocatorFactory::setInstance( $this->getServiceManager() );

        $this->assertTrue( ServiceLocatorFactory::getInstance() instanceof ServiceManager );
    }
}