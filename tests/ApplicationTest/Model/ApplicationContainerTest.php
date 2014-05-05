<?php

namespace ApplicationTest\Model;

use ApplicationTest\TestSuite;
use ServiceLocatorFactory\ServiceLocatorFactory;

/**
 * Application Container
 * 
 * @author Andrea Fiori
 * @since  23 April 2014
 */
class ApplicationContainer
{
    protected $serviceManagerSetterGetter;
    
    public function __construct()
    {
        $this->serviceManagerSetterGetter = new ServiceManagerSetterGetter( ServiceLocatorFactory::getInstance() );
        
    }
}