<?php

namespace Admin\Model\Posts;

use Admin\Model\Posts\PostsFormDataAbstract;

/**
 * Extends FormDataAbstract to set additional properties for the posts form
 * 
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class PostsFormDataContent extends PostsFormDataAbstract
{
    public function setProperties()
    {
        $this->tipo     = "content";
        $this->moduloId = 4;
        
        $record = $this->getRecord();
        if ($record[0]) {
            $this->description = "Modifica contenuto e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
        } else {
            $this->title        = 'Nuovo contenuto';
            $this->description  = 'Inserisci una nuova pagina web';
        }
        
        return $this;
    }
}