<?php

namespace ModelModule\Model\FormData;

use ModelModule\Model\VarExporter;

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
     * @param array|null $record
     * @return array|null
     */
    public function setRecord($record)
    {
        $this->record = $record;
        
        return $this->record;
    }
    
    /**
     * @return array|null
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @param string $propertyName
     * @return string|bool
     */
    public function getProperty($propertyName)
    {
        if ( isset($this->$propertyName) ) {
            return $this->$propertyName;
        }
        
        return false;
    }
}
