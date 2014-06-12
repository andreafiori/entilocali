<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Posts\PostsForm;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Categories\CategoriesGetter;
use Admin\Model\Categories\CategoriesGetterWrapper;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  18 May 2013
 */
class PostsFormDataHandler extends FormDataAbstract
{
    private $postsFormDataObject;
    
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param          = $this->getInput('param', 1);
        $entityManager  = $this->getInput('entityManager', 1);
        //$moduleRecord = $this->getInput("moduleRecord",1);
        
        // TODO: get module id AFTER it take the records data (Forms for the update)
        $this->postsFormDataObject = $this->getPostsFormDataObjectInstance($param['get']['tipo']);
        $this->postsFormDataObject->setPostsGetterWrapper( new PostsGetterWrapper(new PostsGetter($entityManager)) );
        $this->postsFormDataObject->setRecordById($param['route']['id']);
        $this->postsFormDataObject->setProperties();
        $this->postsFormDataObject->setCategoriesGetterWrapper( new CategoriesGetterWrapper( new CategoriesGetter($entityManager)) );
        $this->postsFormDataObject->setCategoriesRecords();
        $this->postsFormDataObject->setCategoriesCheckboxes();

        if ( !$this->postsFormDataObject->getCategoriesRecords() ) {
            $this->setVariable('error', 1);
            $this->setVariable('messageType',   'warning');
            $this->setVariable('messageTitle',  'Nessuna categoria');
            $this->setVariable('messageText',   'Impossibile inserire un nuovo elemento senza categorie in archivio da associare');
            return;
        }
        
        // TODO: check ACL
        
        $this->postsFormDataObject->setForm( new PostsForm() );
        $this->postsFormDataObject->buildForm();
        
        $this->setVariable('formTitle',         $this->postsFormDataObject->getTitle());
        $this->setVariable('formDescription',   $this->postsFormDataObject->getDescription());
        $this->setVariable('form',              $this->postsFormDataObject->getForm());
        $this->setVariable('formAction',        $this->getFormAction($param['get']['tipo']));
       
        $this->setVariable('CKEditorField', 'descrizione');
    }
    
    /**
     * @return string
     */
    public function getFormAction($tipo = null)
    {
        $record = $this->postsFormDataObject->getRecord();
        if ($record) {
            
            $this->setVariable('formBreadCrumbCategory', $record[0]['nome']);
            
            return 'posts/update/';
        }
       
        return 'posts/insert/?tipo='.$tipo;
    }
  
    public function getPostsFormDataObject()
    {
        return $this->postsFormDataObject;
    }
    
        /**
         * @param string $tipo
         * @return \Admin\Model\Posts\PostsFormDataAbstract
         */
        private function getPostsFormDataObjectInstance($tipo)
        {
            $classMap = array(
                "content" => '\Admin\Model\Posts\PostsFormDataContent',
                "foto"    => '\Admin\Model\Posts\PostsFormDataFoto',
                "blog"    => '\Admin\Model\Posts\PostsFormDataBlog',
                "video"   => '\Admin\Model\Posts\PostsFormDataVideo',
            );

            if (isset($classMap[$tipo])) {
                $objectName = $classMap[$tipo];
            } else {
                $objectName = $classMap['content'];
            }
            
            if ( !class_exists($objectName) ) {
                throw new NullException($objectName." class doesn't exist");
            }

            return new $objectName($this->getInput());
        }

}
