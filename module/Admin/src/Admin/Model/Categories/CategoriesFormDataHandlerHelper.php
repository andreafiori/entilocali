<?php

namespace Admin\Model\Categories;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Categories\CategoriesGetterWrapper;
use Application\Model\NullException;

/**
 * TODO:
 *      based moduloId, load form properties 
 *      get moduleId name from moduloId
 * 
 * @author Andrea Fiori
 * @since  10 June 2014
 */
class CategoriesFormDataHandlerHelper extends FormDataAbstract
{
    private $categoriesGetterWrapper;
    
    private $moduleRecord;
    private $currentModuleId;
    private $currentModuleName;

    /**
     * @param \Admin\Model\Categories\CategoriesGetterWrapper $categoriesGetterWrapper
     * @return \Admin\Model\Categories\CategoriesGetterWrapper $this->categoriesGetterWrapper
     */
    public function setCategoriesWrapper(CategoriesGetterWrapper $categoriesGetterWrapper)
    {
        $this->categoriesGetterWrapper = $categoriesGetterWrapper;
        
        return $this->categoriesGetterWrapper;
    }

    /**
     * @param number $id
     * @throws NullException
     */
    public function setRecordById($id)
    {
        if (!$this->categoriesGetterWrapper) {
            throw new NullException("CategorieGetterWrapper object instance is not set");
        }
        
        if (!is_numeric($id)) {
            return false;
        }
   
        $this->categoriesGetterWrapper->setInput( array("id" => $id) );
        $this->categoriesGetterWrapper->setupQueryBuilder();
        
        $this->record = $this->categoriesGetterWrapper->getRecords();
        
        return $this->record;
    }
    
    /**
     * @param  array $moduleRecord
     * @return array
     */
    public function setModuleRecord(array $moduleRecord)
    {
        $this->moduleRecord = $moduleRecord;
        
        return $this->moduleRecord;
    }
    
    /** 
     * @param number $moduloId
     * @throws NullException
     */
    public function setCurrentModule($moduloId = null)
    {
        $moduleRecord   = $this->getModuleRecord();
        $record         = $this->getRecord();
        
        if ( isset($record[0]['modulo']) ) {
            $this->currentModuleId = $record[0]['modulo'];
            $this->currentModuleName = $moduleRecord[$this->currentModuleId];
        }
        
        if ( is_numeric($moduloId) ) {
            $this->currentModuleId = $moduloId;
            $this->currentModuleName = $moduleRecord[$moduloId];
        }
        
        $this->checkCurrentModuleIdAndName();
    }
    
    public function setProperties()
    {
        $this->checkCurrentModuleIdAndName();
        
        $record = $this->getRecord();
        
        if ($record) {
            switch($this->getCurrentModuleId()) {
                case(1):
                    $this->title = $record[0]['nome'];
                    $this->description = 'Modifica categoria blog';
                break;

                case(4):
                    $this->title = $record[0]['nome'];
                    $this->description = 'Modifica categoria di pagine web';
                break;

                case(6):
                    $this->title = 'Nuova categoria foto';
                    $this->description = 'Modifica categoria di foto';
                break;
            }
        } else {
            switch($this->getCurrentModuleId()) {
                case(1):
                    $this->title = 'Nuova categoria Blog';
                    $this->description = 'Inserisci una nuova categoria blog';
                break;

                case(4):
                    $this->title = 'Nuova categoria contenuto';
                    $this->description = 'Inserisci una nuova categoria di pagine web';
                break;

                case(6):
                    $this->title = 'Nuova categoria foto';
                    $this->description = 'Inserisci una nuova categoria di foto';
                break;
            }
        }        
    }
    
    /**
     * @return \Zend\Form\Form
     * @throws NullException
     */
    public function buildForm()
    {
        $this->checkCurrentModuleIdAndName();
        
        $form = $this->getForm();
        if (!$form) {
            throw new NullException("Form is not set");
        }
        
        $record = $this->getRecord();
        if ($record) {
            $form->setData( array_merge($record[0], array("moduloId" => $this->getCurrentModuleId())) );
        } else {
            $form->setData( array("moduloId" => $this->getCurrentModuleId()) );
        }
        
        $this->form = $form;
        
        return $this->form;
    }
       
    public function getCurrentModuleId()
    {
        return $this->currentModuleId;
    }

    public function getCurrentModuleName()
    {
        return $this->currentModuleName;
    }
        
    public function getModuleRecord()
    {
        return $this->moduleRecord;
    }
    
        /**
         * @throws NullException
         */
        private function checkCurrentModuleIdAndName()
        {
            if (!$this->currentModuleId) {
                throw new NullException('Current Module ID is not set');
            }

            if (!$this->currentModuleName) {
                throw new NullException('Current Module name is not set');
            }
        }
}