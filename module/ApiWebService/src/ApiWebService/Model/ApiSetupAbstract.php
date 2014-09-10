<?php

namespace ApiWebService\Model;

use Zend\Http\Response;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  23 August 2014
 */
abstract class ApiSetupAbstract
{
    protected $method;
    protected $allowedMethods = array('GET','POST','PUT','DELETE');
    protected $input;
    protected $authenticationInput;
    
    protected $responseToReturn;
    
    /** @var \Doctrine\ORM\EntityManager **/
    protected $entityManager;  

    /**
     * @param string $method
     * @return string
     */
    public function setMethod($method)
    {
        if ( !in_array($method, $this->allowedMethods) ) {
            $this->setupResponseToReturn(Response::STATUS_CODE_405, 'Method not allowed');
            
            throw new NullException('Method not allowed');
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
     * @return null|array
     */
    public function getInput($key = null)
    {
        if (isset($this->input[$key])) {
            return $this->input[$key];
        }
        
        return $this->input;
    }
    
    /**
     * Setup a Response Object To Return in case of error\s
     * 
     * @param int $code
     * @param string $message
     * @return \Zend\Http\Response
     */
    public function setupResponseToReturn($code, $message)
    {
        $this->responseToReturn = new Response();
        $this->responseToReturn->setStatusCode($code);
        $this->responseToReturn->setContent( json_encode( array_filter( array(
                    'status'    => $this->responseToReturn->getStatusCode(),
                    'method'    => $this->getMethod(),
                    'message'   => $message
                    )
                )
            )
        );
        return $this->responseToReturn;
    }
    
    /**
     * @return array|null
     */
    public function getResponseToReturn()
    {
        return $this->responseToReturn;
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
}