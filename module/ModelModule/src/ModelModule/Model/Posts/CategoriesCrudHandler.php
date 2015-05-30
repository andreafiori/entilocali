<?php

namespace ModelModule\Model\Posts;

use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  08 June 2013
 */
class CategoriesCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    protected function insert()
    {
        try {
            $this->getConnection()->insert('zfcms_categories', array(
                'note'              => Slugifier::slugify($this->rawPost['name']),
                'create_date'        => date("Y-m-d H:i:s"),
                'last_update'        => date("Y-m-d H:i:s"),
                'module_id'         => isset($this->rawPost['moduloId']) ? $this->rawPost['moduloId'] : 4,
                'status'            => $this->rawPost['status'],
            ));
            $categoryId = $this->getConnection()->lastInsertId();
        } catch (\Exception $e) {
            return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
        }

        try {
            $this->getConnection()->insert('zfcms_categories_options', array(
                'name'              => $this->rawPost['name'],
                'description'       => $this->rawPost['description'],
                'seo_url'           => Slugifier::slugify($this->rawPost['name']),
                'seo_title'         => Slugifier::slugify($this->rawPost['name']),
                'seo_keywords'      => $this->rawPost['seoKeywords'],
                'seo_description'   => $this->rawPost['seoDescription'],
                'accesskey'         => $this->rawPost['accesskey'],
                'template_file'     => $this->rawPost['templateFile'],
                'position'          => $this->rawPost['position'] ? $this->rawPost['position'] : 0,
                'parent_id'         => $this->rawPost['parentId'],
                'language_id'       => isset($this->rawPost['languageId']) ? $this->rawPost['languageId'] : 1,
                'category_id'       => $categoryId,
            ));
        } catch (\Exception $e) {
            return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
        }

        $this->setVariables( array(
                'messageType'   => 'success',
                'messageTitle'  => 'Dati inseriti correttamente',
                'messageText'   => 'Dati inseriti correttamente in archivio. Controllare la loro integrit&agrave;'
            )
        );
        
    }

    /**
     * Validate form, update category options record
     */
    protected function update()
    {
        $form = new CategoriesForm();
        $form->setData($this->rawPost);
        if ( !$form->isValid() ) {
            return $this->setErrorMessage("I valori inviati attraverso il form risultano invalidi. Se l'errore persiste, contattare l'amministrazione", 'Form non valido');
        }

        try {
            $this->setArrayRecordToHandle("name", 'name');
            $this->setArrayRecordToHandle("description", 'description');
            $this->setArrayRecordToHandle("seo_description", 'seoDescription');
            $this->setArrayRecordToHandle("seo_keywords", 'seoKeywords');
            $this->getConnection()->update('zfcms_categories_options', $this->getArrayRecordToHandle(), array('category_id' => $this->rawPost['id']) );
        } catch(\Exception $e) {
            return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
        }

        $this->setVariables( array(
                'messageType'   => 'success',
                'messageTitle'  => 'Dati inseriti correttamente',
                'messageText'   => 'Dati in archivio aggiornati correttamente'
            )
        );
        
    }
}