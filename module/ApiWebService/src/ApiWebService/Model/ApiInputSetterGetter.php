<?php

namespace ApiWebService\Model;

use Zend\Http\Response;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class ApiInputSetterGetter extends ApiSetupAbstract
{
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
        protected function validateAuthenticationInput()
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
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
