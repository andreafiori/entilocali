<?php

namespace Application\Model\RouterManagers;

use Admin\Model\InputSetterGetterAbstract;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
abstract class RouterManagerAbstract extends InputSetterGetterAbstract
{
    const defaultFrontendTemplate   = 'homepage/homepage.phtml';
    const defaultBackendTemplate    = 'dashboard/dashboard.phtml';
    
    protected $output = array();
    
    protected $router;

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
        
        return $this->output['template'];
    }
    
    /**
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
    
    /**
     * @param array $records
     */
    public function setRecords($records)
    {
        $this->output['records'] = $records;
        
        return $this->output['records'];
    }
    
    /**
     * @return array or null
     */
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
        
        return $this->output;
    }

    /**
     * @param array $vars
     * @return array
     */
    public function setVariables(array $vars)
    {
        foreach($vars as $key => $value) {
            $this->setVariable($key, $value);
        }
        return $this->output;
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
         * @param array $arrayVar
         */
        protected function exportVariableAsGlobal(array $arrayVar)
        {
            if (!empty($arrayVar)) {
                foreach($arrayVar as $key => $value) {
                    $this->setVariable($key, $value);
                }
            }
        }
}
