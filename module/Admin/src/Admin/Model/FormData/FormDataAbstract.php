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
    
    protected $title, $description, $formAction;
    
    protected $record;

    protected $template = 'formdata/formdata.phtml';
    
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
}
