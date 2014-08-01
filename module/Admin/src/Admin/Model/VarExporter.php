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
     * @param type $key
     * @param type $value
     */
    public function setVariable($key, $value)
    {
        $this->varToExport[$key] = $value;
        
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
    
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this->title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this->description;
    }
    
    public function getRecords()
    {
        return $this->records;
    }

    public function setRecords($records)
    {
        $this->records = $records;
        
        return $this->records;
    }

    /**
     * @return string $this->template
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
}