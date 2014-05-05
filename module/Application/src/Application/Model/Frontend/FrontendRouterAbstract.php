<?php

namespace Application\Model\Frontend;

/**
 * Frontend Router Abstraction Object
 * 
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class FrontendRouterAbstract
{
    protected $input;
    protected $router;
    
    /**
     * @param array $input
     */
    public function setRouter(array $router)
    {
        $this->router = $router;
        
        return $this->router;
    }
    
    /**
     * @param string $key
     * @return string or array
     */
    public function getRouter($key = null)
    {
        if ( isset($this->router[$key]) ) {
            return $this->router[$key];
        }
        
        return $this->router;
    }
    
    /**
     * @param array $input
     */
    public function setInput(array $input)
    {
        $this->input = array_filter($input);
        
        return $this->input;
    }
    
    /**
     * @param string $key
     * @return string or array
     */
    public function getInput($key = null)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        return $this->input;
    }
}