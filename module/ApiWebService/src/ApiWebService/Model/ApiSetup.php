<?php

namespace ApiWebService\Model;

use Admin\Model\Users\UsersGetterWrapper;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class ApiSetup extends ApiSetupAbstract
{
    private $resourceClassMap;

    private $resourceClassName;

    /**
     * @param array|null $key
     * @return array|string
     */
    public function getAuthenticationInput($key = null)
    {
        if (isset($this->authenticationInput[$key])) {
            return $this->authenticationInput[$key];
        }
        
        return $this->authenticationInput;
    }

    /**
     * @param array $resourceClassMap
     * @return array
     */
    public function setResourceClassMap(array $resourceClassMap)
    {
        $this->resourceClassMap = $resourceClassMap;
        
        return $this->resourceClassMap;
    }

    /**
     * @param string $resource
     */
    public function setResourceClassName($resource)
    {
        $this->validateResource($resource);
        
        $this->resourceClassName = $this->resourceClassMap[$resource];
    }
    
        /**
         * Check if class name exists on the record resource class map
         * 
         * @param string $resource
         * @throws NullException
         */
        private function validateResource($resource)
        {
            if ( !isset($this->resourceClassMap[$resource])) {
                $this->setupNullException('Invalid resource. Cannot get the result for this resource.');
            } elseif (!class_exists($this->resourceClassMap[$resource])) {
                $this->setupNullException('Invalid resource. The related object of this resource doesn\'t exists.');    
            }
        }

    /**
     * @return \ApiWebService\Model\ApiResultGetterAbstract
     */
    public function getResourceClassName()
    {
        return $this->resourceClassName;
    }
    
    /**
     * @return string|null
     */
    public function getResourceClassMap()
    {
        return $this->resourceClassMap;
    }
}
