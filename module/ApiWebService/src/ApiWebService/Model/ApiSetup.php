<?php

namespace ApiWebService\Model;

use Zend\Http\Response;
use Admin\Model\Users\UsersGetterWrapper;
use ApiWebService\Model\ApiSetupAbstract;
use Application\Model\NullException;

/**
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
            $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Input is not set');
            
            throw new NullException('Input is not set');
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
                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Unauthorized: no authentication.');

                throw new NullException('Unauthorized: no authentication.');
            }
            
            if ( is_string($this->getAuthenticationInput('username')) 
                 and !is_string($this->getAuthenticationInput('password')) ) {

                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Unauthorized: authentication with invalid parameters.');

                throw new NullException('Unauthorized: authentication with invalid parameters.');
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
     * @return type
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
     * TODO: refactor usersGetterWrapper set operations
     * 
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
            $this->setupResponseToReturn(Response::STATUS_CODE_403, 'Unauthiorized: bad authentication.');

            throw new NullException('Unauthiorized: bad authentication.');
        }
        
        return $arrayToReturn;
    }
    
        /**
         * @throws NullException
         */
        private function assetUsersGetterWrapper()
        {
            if (!$this->usersGetterWrapper) {
                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Error during the request: cannot get user informations.');
                
                throw new NullException('Error during the request: cannot get user informations.');
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
                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Invalid resource. Cannot get the result for this resource.');
                
                throw new NullException('Invalid resource. Cannot get the result for this resource.');
            } elseif (!class_exists($this->resourceClassMap[$resource])) {
                $this->setupResponseToReturn(Response::STATUS_CODE_401, 'Invalid resource. The related object of this resource doesn\'t exists.');

                throw new NullException('Invalid resource. The related object of this resource doesn\'t exists.');    
            }
        }

    /**
     * @return string|null
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
