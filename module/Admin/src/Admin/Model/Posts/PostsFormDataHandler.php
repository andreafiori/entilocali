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
        
        $this->form = new PostsForm();
        
        $param = $this->getInput('param', 1);
        
        // get Record by Id
        if ( is_numeric($param['route']['id']) ) {
            $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager')) );
            $postsGetterWrapper->setInput( array("id" => $param['route']['id']) );
            $postsGetterWrapper->setupQueryBuilder();

            $this->record = $postsGetterWrapper->getRecords();
        }
        
        // detect post type
        $this->tipo = isset($this->record[0]['tipo']) ? $this->record[0]['tipo'] : $param['get']['tipo'];        
        
        // based on record data
        if ( !empty($this->record) ) {
            
            switch($this->tipo):
                default: case("content"):
                    $this->tipo = "content"; // rewrite value
                    $this->moduloId = 4;
                    $this->description = "Modifica contenuto e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                break;

                case("foto"):
                    $this->showUploadImage = 1;
                    $this->moduloId = 6;
                    $this->description = "Modifica foto  e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                break;

                case("blog"):
                    $this->showUploadImage = 1;
                    $this->moduloId = 1;
                    $this->description = "Modifica post e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                break;
            endswitch;
            
            $this->title = $this->record[0]['titolo'];
            $this->formAction = 'posts/'.$this->record[0]['id'];
            
        } else {
            switch($this->tipo):
                default: case("content"):
                    $this->tipo = "content"; // rewrite value
                    $this->moduloId = 4;
                    $this->title = 'Nuovo contenuto';
                    $this->description = 'Inserisci una nuova pagina web';
                break;

                case("foto"):
                    $this->moduloId = 6;
                    $this->showUploadImage = 1;
                    $this->title = 'Nuova foto';                    
                    $this->description = 'Nuova foto nella galleria di immagini';
                break;

                case("blog"):
                    $this->showUploadImage = 1;
                    $this->moduloId = 1;
                    $this->title = 'Nuovo post';
                    $this->description = 'Nuovo blog post';
                break;
            endswitch;
        }
        
        $categorieWrapper = new CategorieGetterWrapper( new CategorieGetter($this->getInput('entityManager', 1)) );
        $categorieWrapper->setInput( array('moduloId' => $this->moduloId, 'orderby'=>'co.nome') );
        $categorieWrapper->setupQueryBuilder();
        $categoriesRecords = $categorieWrapper->getRecords();
        
        $categoriesCheckbox = array();
        foreach ($categoriesRecords as $categorie) {
            if (isset($categorie['id']) and isset($categorie['nome']) ) {
                $categoriesCheckbox[$categorie['id']] = $categorie['nome'];
            }
        }
        
        if ($this->showUploadImage) {
            $this->form->addUploadImage();
        }
        $this->form->addMainFields();
        $this->form->addCategory($categoriesCheckbox, $this->record[0]['categorie']);
        $this->form->addSEO();
        
        $record = array('moduloid' => $this->moduloId, 'tipo' => $this->tipo, 'stato' => PostsUtils::STATE_ACTIVE);
        if (isset($this->record[0])) {
            $this->form->setData( array_merge($record, $this->record[0]) );
        } else {
            $this->form->setData($record);
        }
    }
    
    public function getFormAction()
    {
        if ($this->record) {
            return 'posts/update/';
        }
        
        return 'posts/insert/?'.$this->tipo;
    }

}
