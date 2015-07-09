<?php

namespace ModelModule\Factory\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ModelModule\Service\AppServiceLoader;

class AppServiceLoaderFactory implements FactoryInterface, MutableCreationOptionsInterface
{
    private $creationOptions;
    
    /**
     * @param array $creationOptions
     */
    public function setCreationOptions(array $creationOptions)
    {
        $this->creationOptions = $creationOptions;
        
        return $this->creationOptions;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return AppServiceLoader
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AppServiceLoader($this->creationOptions);
    }
}
