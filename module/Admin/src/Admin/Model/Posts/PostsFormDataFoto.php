<?php

namespace Admin\Model\Posts;

use Admin\Model\Posts\PostsFormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class PostsFormDataFoto extends PostsFormDataAbstract
{
    public function setProperties()
    {
        $this->showUploadImage = 1;
        $this->hideSEOFields   = 1;
        $this->moduloId        = 6;
        
        $record = $this->getRecord();
        if ($record[0]) {
            $this->description = "Modifica foto e conferma le modifiche premendo il pulsante in fondo al form. La pagina non verr&agrave; ricaricata, ma verr&agrave; mostrato l'esito dell'operazione";
        } else {
            $this->title       = "Nuova foto";
            $this->description = "Inserisci una nuova foto nella galleria di immagini";
        }
    }
}