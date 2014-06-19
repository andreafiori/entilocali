<?php

namespace Admin\Model\Posts;

use Admin\Model\Posts\PostsFormDataAbstract;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  15 June 2014
 */
class PostsFormDataConcrete extends PostsFormDataAbstract
{
    protected $showUploadImage;
    protected $hideSEOFields;
    protected $showAttachmentsManagement;
    
    public function setProperties()
    {
        $record = $this->getRecord();

        switch($this->moduleId) {
            
            // blogs
            case(1): case("blog"):
                $this->showUploadImage = 1;
                $this->hideSEOFields   = 1;
                $this->moduleId        = 1;
                
                if ($record[0]) {
                    $this->description = "Modifica post";
                } else {
                    $this->title       = "Nuovo post";
                    $this->description = "Inserisci una nuovo post";
                }
            break;
            
            // contents
            default: case(4): case("content"):
                $this->moduleId = 4;
                
                if ($record[0]) {
                    $this->description  = "Modifica contenuto e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                } else {
                    $this->title        = 'Nuovo contenuto';
                    $this->description  = 'Inserisci una nuova pagina web';
                }
            break;
            
            // photos TODO: description must be a simple textarea, not a WYSIWYG
            case(6): case("foto"):
                $this->showUploadImage = 1;
                $this->hideSEOFields   = 1;
                $this->moduleId        = 6;
                
                if ($record[0]) {
                    $this->description = "Modifica foto e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
                } else {
                    $this->title       = "Nuova foto";
                    $this->description = "Inserisci una nuova foto nella galleria di immagini";
                }
            break;
        }
    }
}