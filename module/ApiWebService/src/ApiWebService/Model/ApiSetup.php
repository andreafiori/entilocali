<?php

namespace ApiWebService\Model;

use Admin\Model\Users\UsersGetterWrapper;
use ApiWebService\Model\ApiSetupAbstract;
use Application\Model\NullException;

/**
 * TODO: refactoring: ApiSetupAuthenticationInput, ApiSetup
 * 
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class ApiSetup extends ApiSetupAbstract
{
    private $usersGetterWrapper;
    private $resourceClassMap;
    private $resourceClassName;

    /**
     * @throws NullException
     */
    public function setupAuthenticationInput()  
    {
        if ( !$this->getInput() ) {
            $this->setupNullException('Input is not set');
        }
        
        $this->authenticationInput = array_filter( array(
            'apiKey'    => isset($this->input['key']) ? $this->input['key'] : null,
            'username'  => isset($this->input['username']) ? $this->input['username'] : null,
            'password'  => isset($this->input['password']) ? $this->input['password'] : null,
            )
        );
        
        $this->validateAuthenticationInput();
    }
        
        /**
         * @throws NullException
         */
        private function validateAuthenticationInput()
        {
            if ( !$this->getAuthenticationInput() ) {
                $this->setupNullException('Unauthorized: no authentication.');
            }
            
            if ( is_string($this->getAuthenticationInput('username')) 
                 and !is_string($this->getAuthenticationInput('password')) ) {
                
                $this->setupNullException('Unauthorized: authentication with invalid parameters.');
            }
        }

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
     * @param \Admin\Model\Users\UsersGetterWrapper $usersGetterWrapper
     * @return \Admin\Model\Users\UsersGetterWrapper
     */
    public function setUsersGetterWrapper(UsersGetterWrapper $usersGetterWrapper)
    {
        $this->usersGetterWrapper = $usersGetterWrapper;
        
        return $this->usersGetterWrapper;
    }
    
    /**
     * @return \Admin\Model\Users\UsersGetterWrapper
     */
    public function getUsersGetterWrapper()
    {
        return $this->usersGetterWrapper;
    }
    
    /**
     * @param array $authenticationInput
     * @return type
     * @throws NullException
     */
    public function authenticate()
    {
        $this->assetUsersGetterWrapper();

        $this->usersGetterWrapper->setInput($this->getInput());
        $this->usersGetterWrapper->setupQueryBuilder();
        $this->usersGetterWrapper->setupPaginator( $this->usersGetterWrapper->setupQuery($this->getEntityManager()) );
        $this->usersGetterWrapper->setupPaginatorCurrentPage();
        $this->usersGetterWrapper->setupPaginatorItemsPerPage();

        $paginator = $this->usersGetterWrapper->getPaginator();
        
        $arrayToReturn = array();
        foreach($paginator as $row) {
            $arrayToReturn[] = $row;
        }

        if ( count($arrayToReturn) != 1 ) {
            $this->setupNullException('Unauthiorized: bad authentication.');
        }
        
        return $arrayToReturn;
    }
    
        /**
         * @throws NullException
         */
        private function assetUsersGetterWrapper()
        {
            if (!$this->usersGetterWrapper) {
                $this->setupNullException('Error during the request: cannot get user informations.');
            }
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
