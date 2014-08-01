<?php

namespace Admin\Model\FormData;

use Admin\Model\VarExporter;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
abstract class FormDataAbstract extends VarExporter
{
    protected $form;
    
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
    
    /**
     * @return \Zend\Form\Form or null
     */
    public function getForm()
    {
        return $this->form;
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
