<?php

namespace Application\Model\FrontendHelpers;

/**
 * Frontend Router Abstraction Object
 * 
 * @author Andrea Fiori
 * @since  05 May 2014
 */
abstract class FrontendRouterAbstract
{
    const defaultTemplate = 'homepage.phtml';
    
    protected $input;
    protected $output = array();
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
     * 
     * @param type $key
     * @param type $noArray
     * @return type
     */
    public function getInput($key = null, $noArray = 0)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        if ( !$noArray ) {
            return $this->input;
        }
    }
    
    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->output['template'] = $template;
    }
    
    public function getTemplate()
    {
        if (isset($this->output['template'])) {
            return $this->output['template'];
        }
        
        return self::defaultTemplate;
    }
    
    public function setRecords($records)
    {
        $this->output['records'] = $records;
    }
    
    public function getRecords()
    {
        if  (isset($this->output['records'])) {
            return $this->output['records'];
        }
    }
    
    public function getOutput()
    {
        return $this->output;
    }
    
    /**
     * Set a variable that will be exported and set on the index controller
     * 
     * @param type $key
     * @param type $value
     */
    public function setFrontendVariable($key, $value)
    {
        if ( !isset($this->output['export']) ) {
            $this->output['export'] = array();
        }
        
        $this->output['export'][$key] = $value;
    }
}