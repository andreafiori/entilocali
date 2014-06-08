<?php

namespace Admin\Model\FormData;

use Admin\Model\InputSetupAbstract;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
abstract class FormDataAbstract extends InputSetupAbstract
{
    protected $form;
    
    protected $title;
    protected $description;
    protected $formAction;
    
    protected $record;

    protected $template = 'formdata/formdata.phtml';
    
    protected $varToExport = array();
    
    /**
     * @param \Zend\Form\Form $form
     */
    public function setForm(\Zend\Form\Form $form)
    {
        $this->form = $form;
    }
    
    public function getForm()
    {
        return $this->form;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
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
     * @param array or null $record
     * @return array or null
     */
    public function setRecord($record)
    {
        $this->record = $record;
        
        return $this->record;
    }
    
    /**
     * @return array or null
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @param string $propertyName
     * @return object property or false
     */
    public function getProperty($propertyName)
    {
        if ( isset($this->$propertyName) ) {
            return $this->$propertyName;
        }
        
        return false;
    }
}
