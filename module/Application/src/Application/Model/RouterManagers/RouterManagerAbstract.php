<?php

namespace Application\Model\RouterManagers;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
abstract class RouterManagerAbstract
{
    const defaultFrontendTemplate   = 'homepage/homepage.phtml';
    const defaultBackendTemplate    = 'dashboard/dashboard.phtml';
    
    protected $input;
    protected $output = array();
    protected $router;

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
         return $this->getArrayValue($this->input, $key, $noArray);
    }
    
    /**
     * @param array $router
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
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->output['template'] = $template;
    }
    
    /**
     * 
     * @param type $isBackend
     * @return type
     */
    public function getTemplate($isBackend = null)
    {
        if (isset($this->output['template'])) {
            return $this->output['template'];
        }
        
        if ($isBackend) {
            return self::defaultBackendTemplate;
        }
        
        return self::defaultFrontendTemplate;
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
    
    /**
     * @param type $key
     * @param type $noArray
     * @return type
     */
    public function getOutput($key = null, $noArray=null)
    {
        return $this->getArrayValue($this->output, $key, $noArray);
    }
    
    /**
     * Set a variable that will be exported and set on the index controller
     * 
     * @param type $key
     * @param type $value
     */
    public function setVariable($key, $value)
    {
        if ( !isset($this->output['export']) ) {
            $this->output['export'] = array();
        }
        
        $this->output['export'][$key] = $value;
    }
    
    /**
     * @return type
     */
    public function getVariable($key)
    {
        if (isset($this->output['export'][$key])) {
            return $this->output['export'][$key];
        }
    }
    
        /**
         * 
         * @param array $array
         * @param type $key
         * @param type $noArray
         * @return array
         */
        private function getArrayValue($array, $key = null, $noArray=null)
        {
            if ( isset($array[$key]) ) {
                return $array[$key];
            }

            if ( !$noArray ) {
                return $array;
            }
        }
}