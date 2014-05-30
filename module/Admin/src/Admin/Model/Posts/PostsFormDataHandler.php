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
    private $showUploadImage;
    private $tipo;
    
    /**
     * Initialize input and form
     * 
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->form  = new PostsForm();
        
        $param = $this->getInput('param', 1);
        $this->record = $this->getPostsRecordById( $param->fromRoute('id') );
        
        if ( !empty($this->record) ) {
            switch($this->record[0]['tipo']):
                default: case("content"):
                    $this->description = "Modifica contenuto e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                break;

                case("foto"):
                    $this->showUploadImage = 1;
                    $this->description = "Modifica foto  e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                break;

                case("blog"):
                    $this->showUploadImage = 1;
                    $this->description = "Modifica post e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                break;
            endswitch;
            
            $this->title = $this->record[0]['titolo'];
            
            if ($this->showUploadImage) {
                $this->form->addUploadImage();
            }
            $this->form->addMainFields();
            $this->form->setData($this->record[0]);
            
            $this->formAction = 'posts/'.$this->record[0]['id'];
            
        } else {
            $this->tipo = $param->fromQuery('tipo');
            switch($this->tipo):
                default: case("content"):
                    $this->title = 'Nuovo contenuto';
                    $this->description = 'Inserisci una nuova pagina web';
                break;

                case("foto"):
                    $this->showUploadImage = 1;
                    $this->title = 'Nuova foto';
                    $this->description = 'Nuova foto nella galleria di immagini';
                break;

                case("blog"):
                    $this->showUploadImage = 1;
                    $this->title = 'Nuovo post';
                    $this->description = 'Nuovo blog post';
                break;
            endswitch;
            
            if ($this->showUploadImage) {
                $this->form->addUploadImage();
            }
            $this->form->addMainFields();
        }
    }
    
    public function getForm()
    {
        return $this->form;
    }
    
    public function getFormAction()
    {
        if ($this->record) {
            return 'posts/update/';
        }
        
        return 'posts/insert/?'.$this->tipo;
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
                $postsGetterWrapper->setupQueryBuilder();

                return $postsGetterWrapper->getRecords();
            }
        }
}
