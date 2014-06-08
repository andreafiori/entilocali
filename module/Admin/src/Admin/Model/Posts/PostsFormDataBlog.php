<?php

namespace Admin\Model\Posts;

use Admin\Model\Posts\PostsFormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class PostsFormDataBlog extends PostsFormDataAbstract
{
    public function setProperties()
    {
        $this->showUploadImage = 1;
        $this->hideSEOFields   = 1;
        $this->moduloId        = 1;
        
        $record = $this->getRecord();
        if ($record[0]) {
            $this->description = "Modifica post";
        } else {
            $this->title       = "Nuovo post";
            $this->description = "Inserisci una nuovo post";
        }
    }
}