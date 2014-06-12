<?php

namespace Admin\Model\Categories;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  09 June 2014
 */
class CategoriesFormDataHandler extends FormDataAbstract
{
    private $categorieFormDataHandlerHelper;
    
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param          = $this->getInput('param', 1);
        $entityManager  = $this->getInput('entityManager', 1);
        $moduloId       = $param['get']['moduloId'];
        
        $this->categorieFormDataHandlerHelper = new CategoriesFormDataHandlerHelper( $this->getInput() );
        $this->categorieFormDataHandlerHelper->setCategoriesWrapper( new CategoriesGetterWrapper(new CategoriesGetter($entityManager)) );
        $this->categorieFormDataHandlerHelper->setRecordById($param['route']['id']);
        $this->categorieFormDataHandlerHelper->setModuleRecord( $this->getModuleRecord() );
        $this->categorieFormDataHandlerHelper->setCurrentModule($moduloId);
        $this->categorieFormDataHandlerHelper->setProperties();
        $this->categorieFormDataHandlerHelper->setForm( new CategorieForm('categorieForm') );
        $this->categorieFormDataHandlerHelper->buildForm();
        
        $this->setVariable('formTitle',         $this->categorieFormDataHandlerHelper->getTitle());
        $this->setVariable('formDescription',   $this->categorieFormDataHandlerHelper->getDescription());
        $this->setVariable('form',              $this->categorieFormDataHandlerHelper->getForm());
        $this->setVariable('formAction',        $this->getFormAction());
        
        $this->setVariable('hideOnSubmit', 1);
        $this->setVariable('formBreadCrumbCategory', 'Categorie');
    }
    
        /**
         * TODO:
         *      set module record on input... 
         *      get module records from db with module label based on language ID
         * 
         * @return array
         */
        private function getModuleRecord()
        {
            return array(
                1 => "Blog",
                4 => "Contenuto",
                6 => "Foto",
            );
        }

    public function getFormAction()
    {
        if ( $this->categorieFormDataHandlerHelper->getRecord() ) {
            return 'categorie/update';
        }
        
        return 'categorie/insert';
    }
}