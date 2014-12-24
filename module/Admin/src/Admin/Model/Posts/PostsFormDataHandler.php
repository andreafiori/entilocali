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
        $routeOption    = isset($param['route']['option']) ? $param['route']['option'] : null;

        $this->postsFormDataConcrete = new PostsFormDataConcrete($this->getInput());
        $this->postsFormDataConcrete->setPostsGetterWrapper( new PostsGetterWrapper(new PostsGetter($entityManager)) );
        $this->postsFormDataConcrete->detectModuleId($routeOption);
        $this->postsFormDataConcrete->setProperties();
        $this->postsFormDataConcrete->setCategoriesGetterWrapper( new CategoriesGetterWrapper( new CategoriesGetter($entityManager)) );
        $this->postsFormDataConcrete->setCategoriesRecords();
        $this->postsFormDataConcrete->setCategoriesCheckboxes();
 
        if ( !$this->postsFormDataConcrete->getCategoriesRecords() ) {

            $this->setVariables(array(
                'error'             => 1,
                'messageType'       => 'warning',
                'messageTitle'      => 'Nessuna categoria',
                'messageText'       => 'Impossibile inserire un nuovo elemento senza categorie in archivio da associare',
                )
            );

            return false;
        }

        $this->postsFormDataConcrete->setForm( new PostsForm() );        
        $this->postsFormDataConcrete->buildForm();

        $this->setVariables(array(
                'formTitle'         => $this->postsFormDataConcrete->getTitle(),
                'formDescription'   => $this->postsFormDataConcrete->getDescription(),
                'form'              => $this->postsFormDataConcrete->getForm(),
                'formAction'        => $this->getFormAction($routeOption),
                'CKEditorField'     => 'description',

                'formBreadCrumbCategory'        => $this->getBreadCrumbCategoryString($routeOption),
                'formBreadCrumbCategoryLink'    => $this->getInput('baseUrl',1).'datatable/posts/'.$routeOption,
            )
        );
    }
    
        /**
         * @param type $option
         * @return type
         */
        private function getBreadCrumbCategoryString($option)
        {
            $breadCrumbCategoryString = !is_numeric($option) ? ucfirst($option) : null;

            $record = $this->postsFormDataConcrete->getRecord();
            if ($record and isset($record[0]['type'])) {
                $breadCrumbCategoryString = ucfirst($record[0]['type']);
            } else {
                $breadCrumbCategoryString = 'Contenuti';
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
            $this->setVariable('formBreadCrumbCategory', $record[0]['categoryName']);
            
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
