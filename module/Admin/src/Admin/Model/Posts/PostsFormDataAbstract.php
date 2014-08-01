<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Categories\CategoriesGetterWrapper;
use Application\Model\NullException;

/**
 * Extends FormDataAbstract to set additional properties for the posts form
 * 
 * @author Andrea Fiori
 * @since  08 June 2014
 */
abstract class PostsFormDataAbstract extends FormDataAbstract
{
    protected $type;
    protected $moduleId;
    
    protected $postsGetterWrapper;
    
    protected $categoriesGetterWrapper;
    protected $categoriesRecords;
    protected $categoriesCheckboxes = array();
    protected $categoriesCheckboxesToSelect;
    
    /**
     * @param \Application\Model\Posts\PostsGetterWrapper $postsGetterWrapper
     * @return type
     */
    public function setPostsGetterWrapper(PostsGetterWrapper $postsGetterWrapper)
    {
        $this->postsGetterWrapper = $postsGetterWrapper;
        
        return $this->postsGetterWrapper;
    }
    
    /**
     * @param \Admin\Model\Categories\CategoriesGetterWrapper $categoriesGetterWrapper
     * @return \Admin\Model\Categories\CategoriesGetterWrapper
     */
    public function setCategoriesGetterWrapper(CategoriesGetterWrapper $categoriesGetterWrapper)
    {
        $this->categoriesGetterWrapper = $categoriesGetterWrapper;
        
        return $this->categoriesGetterWrapper;
    }

    public function setCategoriesRecords()
    {
        if (!$this->categoriesGetterWrapper) {
            throw new NullException("CategoriesGetterWrapper class instance is not set");
        }

        $this->categoriesGetterWrapper->setInput( array('moduleId' => $this->moduleId, 'orderby' => 'co.name') );
        $this->categoriesGetterWrapper->setupQueryBuilder();
        
        $this->categoriesRecords = $this->categoriesGetterWrapper->getRecords();
        
        return $this->categoriesRecords;
    }
    
    public function getCategoriesRecords()
    {
        return $this->categoriesRecords;
    }
    
    /**
     * set ALL categories checkboxes list
     */
    public function setCategoriesCheckboxes()
    {
        $categoriesRecords = $this->getCategoriesRecords();

        if ( $categoriesRecords ) {
            foreach ($categoriesRecords as $category) {
                if ( isset($category['id']) and isset($category['name']) ) {
                    $this->categoriesCheckboxes[$category['id']] = $category['name'];
                }
            }
        }

        return $this->categoriesCheckboxes;
    }
    
    /**
     * Intersect categories IDs to select used categories for the current record
     * 
     * @return array or null
     * @throws NullException
     */
    public function setCategoriesCheckboxesToSelect()
    {
        if (!$this->categoriesGetterWrapper) {
            throw new NullException("CategoriesGetterWrapper class instance is not set");
        }
        
        $record = $this->getRecord();
        if ($record) {
            // $record[0]['categories'] NOT detected...
            $this->categoriesGetterWrapper->setInput( array('id' => '', 'moduleId' => $this->moduleId, 'orderby' => 'co.name') );
            $this->categoriesGetterWrapper->setupQueryBuilder();

            $this->categoriesCheckboxesToSelect = $this->categoriesGetterWrapper->getRecords();
            
            return $this->categoriesCheckboxesToSelect;
        }

    }
    
    /**
     * Given the ID or post type, get the record data or the module ID
     */
    public function detectModuleId($option)
    {
        if (is_numeric($option)) {
            $record = $this->setRecordById($option);
            
            $this->moduleId = $record[0]['module'];
        } else {
            $this->moduleId = $option;
        }
        
        return $this->moduleId;
    }
    
    /**
     * @param type $id
     * @return boolean
     * @throws NullException
     */
    public function setRecordById($id)
    {
        if ( !is_numeric($id) ) {
            return false;
        }
        
        if ( !$this->postsGetterWrapper instanceof PostsGetterWrapper ) {
            throw new NullException("postsGetterWrapper is not set");
        }

        $this->postsGetterWrapper->setInput( array("id" => $id) );
        $this->postsGetterWrapper->setupQueryBuilder();

        $this->record = $this->postsGetterWrapper->getRecords();
        
        return $this->record;
    }
    
    /**
     * Build form object adding all fields and values
     * 
     * @return \Zend\Form\Form
     * @throws NullException
     */
    public function buildForm()
    {
        if (!$this->getForm()) {
            throw new NullException("Form is not set");
        }
        
        if ($this->showUploadImage) {
            $this->form->addUploadImage();
        }
        
        $this->form->addMainFields();
        $this->form->addCategory($this->categoriesCheckboxes, $this->setCategoriesCheckboxesToSelect() );
        
        if (!$this->hideSEOFields) {
            $this->form->addSEO();
        }

        $additionalFormFieldsValues = array('moduleId' => $this->moduleId, 'type' => $this->type, 'status' => PostsUtils::STATE_ACTIVE);
        
        $record = $this->getRecord();
        if ( isset($record[0]) ) {
            $this->title = $record[0]['title'];
            $this->form->setData( array_merge($additionalFormFieldsValues, $record[0]) );
            $this->formAction = 'posts/'.$record[0]['postid'];
        } else {
            $this->form->setData($additionalFormFieldsValues);
            $this->formAction = 'posts/';
        }
        
        return $this->form;
    }
}
