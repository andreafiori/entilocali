<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\FormDataHandlerInterface;
use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Posts\PostsForm;
use Application\Model\Posts\PostsGetter;
use Application\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2013
 */
class PostsFormDataHandler extends FormDataAbstract implements FormDataHandlerInterface
{
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->form  = new PostsForm();
        $param = $this->getInput('param', 1);
        $record = $this->getPostsRecordById( $param->fromRoute('id') );
        
        if ($record) {
            $this->title = $record[0]['titolo'];
            
            $this->form->addMainFields();
            $this->form->setData($record[0]);
            
            $this->setOptionsBasedOnPostTipo($record[0]['tipo']);
        }
    }
    
    public function getForm()
    {
        return $this->form;
    }
    
    public function getFormAction()
    {
        
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
        /**
         * @param number $id
         * @return array
         */
        private function getPostsRecordById($id)
        {
            if (is_numeric($id)) {
                $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager')) );
                $postsGetterWrapper->setInput( array("id" => $id) );
                $postsGetterWrapper->setPostsGetterQueryBuilder();

                return $postsGetterWrapper->getRecords();
            }
        }
        
        /**
         * @param string $tipo
         */
        private function setOptionsBasedOnPostTipo($tipo)
        {
            switch($tipo):
                case("content"):
                    $this->description = 'Modifica contenuto';
                break;
            
                case("foto"):
                    $this->description = 'Modifica foto';
                break;
            
                case("blog"):
                    $this->description = 'Modifica post';
                break;
            endswitch;
        }
}
