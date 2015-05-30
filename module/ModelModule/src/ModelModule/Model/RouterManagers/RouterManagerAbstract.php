<?php

namespace ModelModule\Model\RouterManagers;

use ModelModule\Model\InputSetterGetterAbstract;

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
     * @return string|array
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
     * @param bool $isBackend
     * @return string
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

        return null;
    }
    
    /**
     * @param string $key
     * @param bool $noArray
     * @return mixed
     */
    public function getOutput($key = null, $noArray=null)
    {
        return $this->getArrayValue($this->output, $key, $noArray);
    }
    
    /**
     * Set a variable that will be exported and set on the index controller
     * 
     * @param mixed $key
     * @param mixed $value
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
     * @return mixed
     */
    public function getVariable($key)
    {
        if (isset($this->output['export'][$key])) {
            return $this->output['export'][$key];
        }

        return null;
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
