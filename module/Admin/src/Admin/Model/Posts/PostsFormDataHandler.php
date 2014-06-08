<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Posts\PostsForm;
use Application\Model\Posts\PostsGetter;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Categorie\CategorieGetter;
use Application\Model\Categorie\CategorieGetterWrapper;

/**
 * TODO: switch refactoring: use Admin\Model\FormData\FormDataHandlerInterface;
 * 
 * @author Andrea Fiori
 * @since  18 May 2013
 */
class PostsFormDataHandler extends FormDataAbstract
{
    private $showUploadImage;

    private $tipo;
    
    private $moduloId;
    
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param          = $this->getInput('param', 1);
        $entityManager  = $this->getInput('entityManager', 1);
        $tipo           = isset($this->record[0]['tipo']) ? $this->record[0]['tipo'] : $param['get']['tipo'];
        
        $postsFormDataObject = $this->getPostsFormDataObjectInstance($tipo);
        $postsFormDataObject->setForm( new PostsForm() );
        $postsFormDataObject->setRecord($this->record);
        $postsFormDataObject->setPostsGetterWrapper( new PostsGetterWrapper(new PostsGetter($entityManager)) );
        $postsFormDataObject->setRecordById($param['route']['id']);
        $postsFormDataObject->setProperties();
        $postsFormDataObject->setCategorieGetterWrapper( new CategorieGetterWrapper( new CategorieGetter($entityManager)) );
        $postsFormDataObject->setCategorieRecords();
        $postsFormDataObject->setCategorieCheckboxes();
        $postsFormDataObject->buildForm();
        
        $this->title        = $postsFormDataObject->getTitle();
        $this->description  = $postsFormDataObject->getDescription();
        $this->form         = $postsFormDataObject->getForm();
        $this->formAction   = $this->getFormAction();
    }
    
    public function getFormAction()
    {
        if ($this->record) {
            return 'posts/update/';
        }
        
        return 'posts/insert/?'.$this->tipo;
    }
    
        /**
         * @param string $tipo
         * @return \Admin\Model\Posts\PostsFormDataAbstract
         */
        private function getPostsFormDataObjectInstance($tipo)
        {
            $classMap = array(
                "default" => '\Admin\Model\Posts\PostsFormDataContent',
                "content" => '\Admin\Model\Posts\PostsFormDataContent',
                "foto"    => '\Admin\Model\Posts\PostsFormDataFoto',
                "blog"    => '\Admin\Model\Posts\PostsFormDataBlog',
            );

            if (isset($classMap[$tipo])) {
                $objectName = $classMap[$tipo];
            } else {
                $objectName = $classMap['default'];
            }
            
            if ( !class_exists($objectName) ) {
                throw new \Application\Model\NullException($objectName." class doesn't exist");
            }

            return new $objectName($this->getInput());
        }
}
