<?php

namespace ApiWebService\Model;

use Zend\Http\Response;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  23 August 2014
 */
class ApiResourceHandler extends ApiSetupAbstract
{    
    private $resourceClassMap, $resourceClassName;
    
    public function __construct()
    {
        $this->resourceClassMap = array(
            'contents'                      => 'ApiWebService\Model\Resources\PostsApiResource',
            'blogs'                         => 'ApiWebService\Model\PostsApiResource',
            'albo-pretorio'                 => 'ApiWebService\Model\AlboPretorioApiResource',
            'atti-ufficiali'                => 'ApiWebService\Model\AlboPretorioApiResource',
            'stato-civile'                  => 'ApiWebService\Model\PostsApiResource',
            'amministrazione-trasparente'   => 'ApiWebService\Model\AmministrazioneTrasparenteApiResource',
        );
    }

    public function setResourceClassMap(array $resourceClassMap)
    {
        $this->resourceClassMap = $resourceClassMap;
        
        return $this->resourceClassMap;
    }

    /**
     * @param type $resource
     */
    public function setResourceClassName($resource)
    {
        $this->validateResource($resource);
        
        $this->resourceClassName = $this->resourceClassMap[$resource];
    }

        private function validateResource($resource)
        {
            if ( !isset($this->resourceClassMap[$resource])) {
                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Invalid resource. Cannot get the result for this resource.');
                
                throw new NullException('Invalid resource. Cannot get the result for this resource.');
            } elseif (!class_exists($this->resourceClassMap[$resource])) {
                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Invalid resource. The related object of this resource doesn\'t exists.');
            
                throw new NullException('Invalid resource. The related object of this resource doesn\'t exists.');    
            }
        }
        
    public function getResourceClassName()
    {
        return $this->resourceClassName;
    }

    public function getResourceClassMap()
    {
        return $this->resourceClassMap;
    }
}