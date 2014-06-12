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

    protected $showUploadImage;
    protected $hideSEOFields;

    protected $showAttachmentsManagement;
    
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
     * set categorie checkboxes list
     */
    public function setCategoriesCheckboxes()
    {
        $categoriesRecords = $this->getCategoriesRecords();
        
        if ( !$categoriesRecords ) {
            return false;
        }
        
        foreach ($categoriesRecords as $category) {
            if (isset($category['id']) and isset($category['name']) ) {
                $this->categoriesCheckboxes[$category['id']] = $category['name'];
            }
        }
        
        return $this->categoriesCheckboxes;
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

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        
        return $this->tipo;
    }

    public function getTipo()
    {
        return $this->tipo;
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
        $this->form->addCategory($this->categoriesCheckboxes, $this->record[0]['category']);
        
        if (!$this->hideSEOFields) {
            $this->form->addSEO();
        }

        $additionalFormFieldsValues = array('moduleId' => $this->moduleId, 'type' => $this->type, 'status' => PostsUtils::STATE_ACTIVE);
        
        $record = $this->getRecord();
        if ( isset($record[0]) ) {
            $this->title = $record[0]['title'];
            $this->form->setData( array_merge($additionalFormFieldsValues, $record[0]) );
            $this->formAction = 'posts/'.$record[0]['id'];
        } else {
            $this->form->setData($additionalFormFieldsValues);
            $this->formAction = 'posts/';
        }
        
        return $this->form;
    }
    
    abstract public function setProperties();
    
}
