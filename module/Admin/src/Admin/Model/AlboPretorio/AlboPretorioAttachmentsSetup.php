<?php

namespace Admin\Model\AlboPretorio;

/**
 * @author Andrea Fiori
 * @since  28 October 2014
 */
class AlboPretorioAttachmentsSetup
{
    private $moduleId;
    
    private $moduleName;
    
    private $moduleClassName;
    
    private $moduleClassInstance;
    
    private $classMap;
    
    /**
     * @param int $moduleId
     * @return int|null
     */
    public function setModuleId($moduleId)
    {
        if (is_int($moduleId)) {
            $this->moduleId = $moduleId;
        }
        
        return $this->moduleId;
    }
    
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**    
     * @param string $moduleClassName
     */
    public function setModuleClassName($moduleClassName)
    {
        $this->moduleClassName = $moduleClassName;
    }
    
    public function getModuleClassName()
    {
        return $this->moduleClassName;
    }
    
    /**
     * 
     * @param type $moduleClassInstance
     * @param type $objectType
     */
    public function setModuleClassInstance($moduleClassInstance, $objectType)
    {
        $this->moduleClassInstance = $moduleClassInstance;
    }
    
    public function getModuleClassInstance()
    {
        return $this->moduleClassInstance;
    }
    
    /**
     * @param string $moduleName
     * @return string
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
        
        return $this->moduleName;
    }

    /**
     * @return string|null
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }
    
    /**
     * @param array $classMap
     * @return array|null
     */
    public function setClassMap(array $classMap)
    {
        $this->classMap = $classMap;
        
        return $this->classMap;
    }
    
    /**
     * @return array|null
     */
    public function getClassMap()
    {
        return $this->classMap;
    }
}
