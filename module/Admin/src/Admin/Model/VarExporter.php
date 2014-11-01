<?php

namespace Admin\Model;

use Admin\Model\InputSetupAbstract;

/**
 * Common var exporter for datatables and formData
 * 
 * @since  30 July 2014
 * @author Andrea Fiori
 */
class VarExporter extends InputSetupAbstract
{
    protected $title, $description;
    
    protected $records;
    
    protected $template;
    
    protected $varToExport = array();

    /**
     * Set a variable to export and use on FormDataHandler
     * 
     * @param string $key, string $value
     * @param array $value
     */
    public function setVariable($key, $value)
    {
        $this->varToExport[$key] = $value;
        
        return $this->varToExport;
    }
    
    /**
     * 
     * @param array $vars
     * @return array
     */
    public function setVariables(array $vars)
    {
        foreach($vars as $key => $value) {
            $this->setVariable($key, $value);
        }

        return $this->varToExport;
    }
    
    /**
     * @return array
     */
    public function getVarToExport($key = null, $noArray = null)
    {
        if (isset($this->varToExport[$key])) {
            return $this->varToExport[$key];
        }
        
        if (!$noArray) {
            return $this->varToExport;
        }
    }
    
    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        
        return $this->template;
    }
    
    /**
     * @param string $title
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this->title;
    }
    
    /**
     * @param string $description
     * @return string
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this->description;
    }
    
    /**
     * @param array $records
     * @return array
     */
    public function setRecords($records)
    {
        $this->records = $records;
        
        return $this->records;
    }

    /**
     * @return array|null
     */
    public function getRecords()
    {
        return $this->records;
    }
    
    /**
     * @return string $this->template
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    /**
     * @return array|null
     */    
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @return array|null
     */
    public function getDescription()
    {
        return $this->description;
    }
}