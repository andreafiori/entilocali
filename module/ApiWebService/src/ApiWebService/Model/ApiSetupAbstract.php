<?php

namespace ApiWebService\Model;

use ModelModule\Model\NullException;

abstract class ApiSetupAbstract
{
    protected $method;
    protected $allowedMethods = array('GET','POST','PUT','DELETE');
    protected $input;
    protected $authenticationInput;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    protected $statusCode = 200;

    /**
     * @param string $method
     * @return string
     */
    public function setMethod($method)
    {
        if ( !in_array($method, $this->allowedMethods) ) {
            $this->setupNullException('Method not allowed');
        }

        $this->method = $method;
        
        return $this->method;
    }
    
    /**
     * @return string|null
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param array $input
     * @return array
     */
    public function setInput($input)
    {
        $this->input = $input;
        
        return $this->input;
    }
    
    /**
     * @param null|array $key
     * @return string
     */
    public function getInput($key = null)
    {
        if (isset($this->input[$key])) {
            return $this->input[$key];
        }
        
        return $this->input;
    }
    
    /**
     * @param int $statusCode
     * @return int
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        
        return $this->statusCode;
    }
    
    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        
        return $this->entityManager;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
    
        /**
         * Set status code and throw NullException
         * 
         * @param string $message
         * @param int $statusCode
         *
         * @throws NullException
         */
        protected function setupNullException($message, $statusCode = 401)
        {
            $this->setStatusCode($statusCode);
            
            throw new NullException($message);
        }
}