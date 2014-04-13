<?php

namespace ApiWebServiceTest;

use Zend\ServiceManager\ServiceManager;

// Container of vars
abstract class SetupManagerAbstract
{
    /* array for the final results */
    protected $setupRecord;

    protected $serviceManager;
    protected $entityManager;
    protected $queryBuilder;
    protected $appConfigs;
    protected $isMultiLanguage;
}

class SetupServiceManagerDecorator
{
    private $serviceManager;

    /**
     * @return the $serviceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * 
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this->serviceManager;
    }
}


class SetupServiceManagerDecoratorTest // extends \PHPUnit_Framework_TestCase
{
    private $setupServiceManagerDecorator;
	
    public function testSetSetupInput()
    {
        $this->setupServiceManagerDecorator = new SetupServiceManagerDecorator();
        
        $this->setupServiceManagerDecorator->setServiceManager($serviceManager);
    }
}
