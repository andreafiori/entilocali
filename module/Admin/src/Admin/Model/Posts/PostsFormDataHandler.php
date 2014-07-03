<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Posts\PostsForm;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Categories\CategoriesGetter;
use Admin\Model\Categories\CategoriesGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2013
 */
class PostsFormDataHandler extends FormDataAbstract
{
    private $postsFormDataConcrete;
    
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param          = $this->getInput('param', 1);
        $entityManager  = $this->getInput('entityManager', 1);
        
        $this->postsFormDataConcrete = new PostsFormDataConcrete($this->getInput());
        $this->postsFormDataConcrete->setPostsGetterWrapper( new PostsGetterWrapper(new PostsGetter($entityManager)) );
        $this->postsFormDataConcrete->detectModuleId($param['route']['option']);
        $this->postsFormDataConcrete->setProperties();
        $this->postsFormDataConcrete->setCategoriesGetterWrapper( new CategoriesGetterWrapper( new CategoriesGetter($entityManager)) );
        $this->postsFormDataConcrete->setCategoriesRecords();
        $this->postsFormDataConcrete->setCategoriesCheckboxes();
        
        if ( !$this->postsFormDataConcrete->getCategoriesRecords() ) {
            $this->setVariable('error', 1);
            $this->setVariable('messageType',   'warning');
            $this->setVariable('messageTitle',  'Nessuna categoria');
            $this->setVariable('messageText',   'Impossibile inserire un nuovo elemento senza categorie in archivio da associare');
            return false;
        }

        $this->postsFormDataConcrete->setForm( new PostsForm() );
        $this->postsFormDataConcrete->buildForm();
        
        $this->setVariable('formTitle',         $this->postsFormDataConcrete->getTitle());
        $this->setVariable('formDescription',   $this->postsFormDataConcrete->getDescription());
        $this->setVariable('form',              $this->postsFormDataConcrete->getForm());
        $this->setVariable('formAction',        $this->getFormAction($param['route']['option']));
        
        $this->setVariable('CKEditorField', 'description');
        $this->setVariable('formBreadCrumbCategory', $this->getBreadCrumbCategoryString($param['route']['option']) );
        $this->setVariable('formBreadCrumbCategoryLink', $this->getInput('baseUrl',1).'datatable/posts/'.$param['route']['option']);
    }
    
        /**
         * @param type $option
         * @return type
         */
        private function getBreadCrumbCategoryString($option)
        {
            !is_numeric($option) ? $breadCrumbCategoryString = ucfirst($option) : $breadCrumbCategoryString = null;

            $record = $this->postsFormDataConcrete->getRecord();
            if ($record) {
                $breadCrumbCategoryString = ucfirst($record[0]['type']);
            }

            return $breadCrumbCategoryString;
        }
    
    /**
     * @return string
     */
    public function getFormAction($type = null)
    {
        $record = $this->postsFormDataConcrete->getRecord();
        if ($record) {
            $this->setVariable('formBreadCrumbCategory', $record[0]['name']);
            
            return 'posts/update/';
        }

        return 'posts/insert/'.$type;
    }
    
    /**
     * @return type
     */
    public function getPostsFormDataConcrete()
    {
        return $this->postsFormDataConcrete;
    }
}
