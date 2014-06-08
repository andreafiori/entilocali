<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\FormDataAbstract;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Categorie\CategorieGetterWrapper;
use Application\Model\NullException;

/**
 * Extends FormDataAbstract to set additional properties for the posts form
 * 
 * @author Andrea Fiori
 * @since  08 June 2014
 */
abstract class PostsFormDataAbstract extends FormDataAbstract
{
    protected $tipo;
    protected $moduloId;
    
    protected $postsGetterWrapper;
    
    protected $categorieGetterWrapper;
    protected $categorieRecords;
    protected $categorieCheckboxes = array();

    protected $showUploadImage;
    protected $hideSEOFields;

    protected $showAttachmentsManagement;
    
    /**
     * 
     * @param \Application\Model\Posts\PostsGetterWrapper $postsGetterWrapper
     * @return type
     */
    public function setPostsGetterWrapper(PostsGetterWrapper $postsGetterWrapper)
    {
        $this->postsGetterWrapper = $postsGetterWrapper;
        
        return $this->postsGetterWrapper;
    }
    
    /**
     * @param \Application\Model\Categorie\CategorieGetterWrapper $categorieGetterWrapper
     * @return \Application\Model\Categorie\CategorieGetterWrapper $this->categorieGetterWrapper
     */
    public function setCategorieGetterWrapper(CategorieGetterWrapper $categorieGetterWrapper)
    {
        $this->categorieGetterWrapper = $categorieGetterWrapper;
        
        return $this->categorieGetterWrapper;
    }
    
    public function setCategorieRecords()
    {
        if (!$this->categorieGetterWrapper) {
            throw new NullException("CategorieGetterWrapper class instance is not set");
        }

        $this->categorieGetterWrapper->setInput( array('moduloId' => $this->moduloId, 'orderby' => 'co.nome') );
        $this->categorieGetterWrapper->setupQueryBuilder();
        
        $this->categorieRecords = $this->categorieGetterWrapper->getRecords();
        
        return $this->categorieRecords;
    }
    
    public function getCategorieRecords()
    {
        return $this->categorieRecords;
    }

    /**
     * set categorie checkboxes list
     */
    public function setCategorieCheckboxes()
    {
        $categorieRecords = $this->getCategorieRecords();
        
        if ( !$categorieRecords ) {
            return false;
        }
        
        foreach ($categorieRecords as $categorie) {
            if (isset($categorie['id']) and isset($categorie['nome']) ) {
                $this->categorieCheckboxes[$categorie['id']] = $categorie['nome'];
            }
        }
        
        return $this->categorieCheckboxes;
    }

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
     */
    public function buildForm()
    {
        $form = $this->getForm();
        
        if ($this->showUploadImage) {
            $this->form->addUploadImage();
        }
        $this->form->addMainFields();
        $this->form->addCategory($this->categorieCheckboxes, $this->record[0]['categorie']);
        if (!$this->hideSEOFields) {
            $this->form->addSEO();
        }

        $additionalFormFieldsValues = array('moduloid' => $this->moduloId, 'tipo' => $this->tipo, 'stato' => PostsUtils::STATE_ACTIVE);
        $record = $this->getRecord();
        if ( isset($record[0]) ) {
            $this->title = $record[0]['titolo'];
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
