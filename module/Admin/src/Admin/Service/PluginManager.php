<?php

namespace Admin\Service;
  
use Zend\ServiceManager\AbstractPluginManager;

class PluginManager extends AbstractPluginManager
{
    protected $invokableClasses = array(
        
    );
    
    protected $factories = array(
        'appserviceloader' => 'Admin\Factory\Service\AppServiceLoaderFactory',
    );
    
    /**
     * @param \Admin\Service\PluginInterface $plugin
     * @return null
     * @throws \InvalidArgumentException
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof PluginInterface) {
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement %s\PluginInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}